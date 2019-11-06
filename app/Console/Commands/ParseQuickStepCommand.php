<?php

namespace App\Console\Commands;

use App\Catalog;
use App\CatalogProduct;
use App\CatalogProductFilter;
use App\FilterOption;
use App\Image;
use Illuminate\Console\Command;
use File;
use Illuminate\Support\Str;
use Storage;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ParseQuickStepCommand
 * @package App\Console\Commands
 */
class ParseQuickStepCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:parse-quick-step';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private const DOMAIN = 'https://www.quick-step.ru';

    private static $linksOfLaminat = [
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/castle' => ['name' => 'Castle', 'alias' => 'кастл'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/classic' => ['name' => 'Classic', 'alias' => 'классик'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/creo-plus' => ['name' => 'Creo Plus', 'alias' => 'крео-плюс'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/desire' => ['name' => 'Desiré', 'alias' => 'дизайр'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/eligna' => ['name' => 'Eligna', 'alias' => 'элигна'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/impressive' => ['name' => 'Impressive', 'alias' => 'импрессив'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/impressive-patterns' => ['name' => 'Impressive patterns', 'alias' => 'импрессив-паттернс'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/impressive-ultra' => ['name' => 'Impressive Ultra', 'alias' => 'импрессив-ультра'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/majestic' => ['name' => 'Majestic', 'alias' => 'маджестик'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/perspective' => ['name' => 'Perspective', 'alias' => 'перспектив'],
        '/ru-RU/%D0%BB%D0%B0%D0%BC%D0%B8%D0%BD%D0%B0%D1%82/rustic' => ['name' => 'Rustic', 'alias' => 'растик'],
    ];

    private static $linksOfVinil = [
        '/ru-RU/винил/ambient-click' => ['name' => 'Ambient Click', 'alias' => 'амбиент-клик'],
        '/ru-RU/винил/ambient-glue-plus' => ['name' => 'Ambient Glue Plus', 'alias' => 'амбиент-глу-плюс'],
        '/ru-RU/винил/ambient-rigid-click' => ['name' => 'Ambient Rigid Click', 'alias' => 'амбиент-ригид-клик'],
        '/ru-RU/винил/balance-click' => ['name' => 'Balance Click', 'alias' => 'баланс-клик'],
        '/ru-RU/винил/balance-glue-plus' => ['name' => 'Balance Glue Plus', 'alias' => 'баланс-глу-плюс'],
        '/ru-RU/винил/balance-rigid-click' => ['name' => 'Balance Rigid Click', 'alias' => 'баланс-ригид-клик'],
        '/ru-RU/винил/pulse-click' => ['name' => 'Pulse Click', 'alias' => 'пульс-клик'],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(count(self::$linksOfVinil));
        $bar->start();

        foreach (self::$linksOfVinil as $key => $meta) {
            $this->parseCollection($key, $meta);

            $bar->advance();
        }

        $bar->finish();

        $this->line('');

        $this->info('Well done!');

        return true;
    }

    /**
     * @param string $key
     * @param array $meta
     */
    private function parseCollection(string $key, array $meta): void
    {
        $catalog = new Catalog();
        $catalog->parent_id = 21;
        $catalog->name = $meta['name'];
        $catalog->alias = $meta['alias'];
        $catalog->title = $catalog->name . ' | море-ламината.рф';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас.';

        if (!Catalog::whereAlias($catalog->alias)->exists() && $catalog->save()) {

            $document = file_get_contents(self::DOMAIN . self::myUrlEncode($key));

            $crawler = new Crawler($document);

            $products = $crawler->filter('.row .c-card')->each(static function (Crawler $node) {

                $image = $node->filter('img')->first()->attr('src');
                $image = str_replace('=25', '=300', $image);

                return [
                    'name' => trim($node->filter('.c-card__ttl')->first()->text()),
                    'link' => self::myUrlEncode($node->filter('a')->first()->attr('href')),
                    'image' => str_replace(' ','%20', $image)
                ];
            });

            if ($products) {
                foreach ($products as $product) {
                    $this->parseProduct($product, $catalog->id);
                }
            }
        }

        //$this->info('Категория ' . $catalog->name . ' успешно создана');
    }

    /**
     * @param array $product
     * @param int $catalogId
     */
    private function parseProduct(array $product, int $catalogId): void
    {
        $document = file_get_contents(self::DOMAIN . $product['link']);

        $crawler = new Crawler($document);

        $newProduct = new CatalogProduct();
        $newProduct->catalog_id = $catalogId;
        $newProduct->name = $product['name'];
        $newProduct->title = $newProduct->name . ' | море-ламината.рф';
        $newProduct->description = $newProduct->name . ', выгодные предложения для Вас.';
        $newProduct->price = 0;

        $newProduct->alias = mb_strtolower(str_replace(' ', '-', $newProduct->name));
        if (CatalogProduct::where('alias', $newProduct->alias)->exists()) {
            $metaTitle = $crawler->filter('title')->first()->text();
            [$model, $name] = explode('|', $metaTitle);

            $newProduct->alias .= '-' . trim($model);
        }

        $newProduct->text = $crawler->filter('.c-product-detail__usp-list')->first()->html();

        if ($newProduct->save() && $product['image']) {

            $name = Str::random(40);

            $ext = 'jpg';

            $path = Storage::path('public/test_items') . '/' . $name . '.' . $ext;

            if(File::copy($product['image'], $path)) {
                $newImage = new Image();
                $newImage->path = '/storage/images/' . $name . '.' . $ext;
                $newImage->imageable_type = CatalogProduct::class;
                $newImage->imageable_id = $newProduct->id;
                $newImage->alt = $newProduct->name;

                $newImage->save();
            }
        }

        $filters = $crawler->filter('#collapseSpecifications table tr[data-webid="specificationblock-element"]')->each(static function (Crawler $node) {

            return [
                'type' => $node->filter('td')->first()->text(),
                'value' => $node->filter('td')->eq(1)->text()
            ];
        });

        foreach ($filters as $filter) {
            $this->checkFilter($newProduct, $filter);
        }

        //$this->info('Товар ' . $newProduct->name . ' успешно создан');
    }

    /**
     * @param CatalogProduct $newProduct
     * @param array $filter
     */
    private function checkFilter(CatalogProduct $newProduct, array $filter): void
    {
        if ($filter['type'] === 'Количество фасок' && !CatalogProductFilter::where('filter_id', 2)->where('catalog_product_id', $newProduct->id)->exists()) {
            if (!CatalogProductFilter::where('filter_id', 2)->where('catalog_product_id', $newProduct->id)->exists()) {
                $newFilterOptionCheck = new CatalogProductFilter();
                $newFilterOptionCheck->catalog_product_id = $newProduct->id;
                $newFilterOptionCheck->filter_id = 2;
                $newFilterOptionCheck->filter_option_id = 4;
                $newFilterOptionCheck->save();
            } else {
                $newFilterOptionCheck = new CatalogProductFilter();
                $newFilterOptionCheck->catalog_product_id = $newProduct->id;
                $newFilterOptionCheck->filter_id = 2;
                $newFilterOptionCheck->filter_option_id = 5;
                $newFilterOptionCheck->save();
            }
        }

        if ($filter['type'] === 'Толщина') {

            $filterFind = FilterOption::firstOrCreate([
                'filter_id' => 3,
                'name' => $filter['value']
            ]);

            $newFilterOptionCheck = new CatalogProductFilter();
            $newFilterOptionCheck->catalog_product_id = $newProduct->id;
            $newFilterOptionCheck->filter_id = 3;
            $newFilterOptionCheck->filter_option_id = $filterFind->id;
            $newFilterOptionCheck->save();
        }

        if ($filter['type'] === 'Цвет') {

            $filterFind = FilterOption::firstOrCreate([
                'filter_id' => 1,
                'name' => $filter['value']
            ]);

            $newFilterOptionCheck = new CatalogProductFilter();
            $newFilterOptionCheck->catalog_product_id = $newProduct->id;
            $newFilterOptionCheck->filter_id = 1;
            $newFilterOptionCheck->filter_option_id = $filterFind->id;
            $newFilterOptionCheck->save();
        }
    }

    /**
     * @param string $s
     * @return string
     */
    private static function myUrlEncode(string $s): string
    {
        $s = strtr ($s, array (' '=> '%20', 'а'=>'%D0%B0', 'А'=>'%D0%90','б'=>'%D0%B1', 'Б'=>'%D0%91', 'в'=>'%D0%B2', 'В'=>'%D0%92', 'г'=>'%D0%B3', 'Г'=>'%D0%93', 'д'=>'%D0%B4', 'Д'=>'%D0%94', 'е'=>'%D0%B5', 'Е'=>'%D0%95', 'ё'=>'%D1%91', 'Ё'=>'%D0%81', 'ж'=>'%D0%B6', 'Ж'=>'%D0%96', 'з'=>'%D0%B7', 'З'=>'%D0%97', 'и'=>'%D0%B8', 'И'=>'%D0%98', 'й'=>'%D0%B9', 'Й'=>'%D0%99', 'к'=>'%D0%BA', 'К'=>'%D0%9A', 'л'=>'%D0%BB', 'Л'=>'%D0%9B', 'м'=>'%D0%BC', 'М'=>'%D0%9C', 'н'=>'%D0%BD', 'Н'=>'%D0%9D', 'о'=>'%D0%BE', 'О'=>'%D0%9E', 'п'=>'%D0%BF', 'П'=>'%D0%9F', 'р'=>'%D1%80', 'Р'=>'%D0%A0', 'с'=>'%D1%81', 'С'=>'%D0%A1', 'т'=>'%D1%82', 'Т'=>'%D0%A2', 'у'=>'%D1%83', 'У'=>'%D0%A3', 'ф'=>'%D1%84', 'Ф'=>'%D0%A4', 'х'=>'%D1%85', 'Х'=>'%D0%A5', 'ц'=>'%D1%86', 'Ц'=>'%D0%A6', 'ч'=>'%D1%87', 'Ч'=>'%D0%A7', 'ш'=>'%D1%88', 'Ш'=>'%D0%A8', 'щ'=>'%D1%89', 'Щ'=>'%D0%A9', 'ъ'=>'%D1%8A', 'Ъ'=>'%D0%AA', 'ы'=>'%D1%8B', 'Ы'=>'%D0%AB', 'ь'=>'%D1%8C', 'Ь'=>'%D0%AC', 'э'=>'%D1%8D', 'Э'=>'%D0%AD', 'ю'=>'%D1%8E', 'Ю'=>'%D0%AE', 'я'=>'%D1%8F', 'Я'=>'%D0%AF'));
        return $s;
    }
}
