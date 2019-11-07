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
 * Class ParseTarkettCommand
 * @package App\Console\Commands
 */
class ParseTarkettCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:parse-tarkett';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private const DOMAIN = 'https://www.tarkett.ru';

    private static $linksOfLaminat = [
        '/ru_RU/collection-C000129-lamin-art' => [
            'name' => "LAMIN'ART",
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Laminart.jpg',
            'alias' => 'ламинарт',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000129-lamin-art/black-buzz',
                'https://www.tarkett.ru/ru_RU/collection-C000129-lamin-art/painted-white',
                'https://www.tarkett.ru/ru_RU/collection-C000129-lamin-art/patchwork-latte',
                'https://www.tarkett.ru/ru_RU/collection-C000129-lamin-art/white-buzz'
            ]
        ],
        '/ru_RU/collection-C000947-fiesta' => [
            'name' => 'FIESTA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Fiesta.jpg',
            'alias' => 'фиеста',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-grave',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-presto',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-stretto',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-adagio',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-calido',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-caliente',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-castano',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-lorenzo',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-osorno',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-suave',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-sincero',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/oak-vivo',
                'https://www.tarkett.ru/ru_RU/collection-C000947-fiesta/pine-andante',
            ]
        ],
        '/ru_RU/collection-C000952-artisan' => [
            'name' => 'ARTISAN',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Artisan.jpg',
            'alias' => 'артизан',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-tate-modern',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-lazaro-contemporary',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-lazaro-art',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-louvre-ar',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-louvre-classic',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-tate-classic',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-tate-authentic',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-prado-contemporary',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-orsay-modern',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-odeon-classic',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-nancy-modern',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-nancy-classic',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-lazaro-modern',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/oak-louvre-modern',
                'https://www.tarkett.ru/ru_RU/collection-C000952-artisan/teak-luxor-contemporary'
            ]
        ],
        '/ru_RU/collection-C000954-riviera' => [
            'name' => 'RIVIERA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Riviera.jpg',
            'alias' => 'ривьера',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/antibes',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/castellane',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-grasse',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-marseille',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-monaco',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-nizza',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-portofino',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-saint-tropez',
                'https://www.tarkett.ru/ru_RU/collection-C000954-riviera/oak-sanremo'
            ]
        ],
        '/ru_RU/collection-C000955-monaco' => [
            'name' => 'MONACO',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Monaco.jpg',
            'alias' => 'монако',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/bellagio',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/casino',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/cristal',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/crown',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/marina-bay',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/monte-carlo',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/palace',
                'https://www.tarkett.ru/ru_RU/collection-C000955-monaco/vegas'
            ]
        ],
        '/ru_RU/collection-C001093-ballet' => [
            'name' => 'BALLET',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Ballet.jpg',
            'alias' => 'баллет',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/bayaderka',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/carmen',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/esmeralda',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/giselle',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/hamlet',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/korsar',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/manon',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/nutcracker',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/spartacus',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/shaherezada',
                'https://www.tarkett.ru/ru_RU/collection-C001093-ballet/sylphide'
            ]
        ],
        '/ru_RU/collection-C001382-cruise' => [
            'name' => 'CRUISE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Cruise.jpg',
            'alias' => 'круиз',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/azamara',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/carnival',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/celebrity',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/costa',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/cunard',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/oceania',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/princess',
                'https://www.tarkett.ru/ru_RU/collection-C001382-cruise/regent'
            ]
        ],
        '/ru_RU/collection-C001677-poem' => [
            'name' => 'POEM',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Poem.jpg',
            'alias' => 'поэм',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/baudelaire',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/boccaccio',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/burns',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/byron',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/goethe',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/homer',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/petrarca',
                'https://www.tarkett.ru/ru_RU/collection-C001677-poem/shakespeare'
            ]
        ],
        '/ru_RU/collection-C001678-pervaya-sibirskaya' => [
            'name' => 'ПЕРВАЯ Сибирская',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_TAIGA_PERVAYA_Sibirskay.jpg',
            'alias' => 'первая-сибирская',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/dub-korichnevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/dub-svetlyy',
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/dub-temno-korichnevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/yasen-zheltyy',
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/yasen-korichnevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001678-pervaya-sibirskaya/yasen-seryy'
            ]
        ],
        '/ru_RU/collection-C000347-vintage' => [
            'name' => 'VINTAGE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Art_vintage.jpg',
            'alias' => 'винтаж',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000347-vintage/linen-wood',
                'https://www.tarkett.ru/ru_RU/collection-C000347-vintage/rawhide',
                'https://www.tarkett.ru/ru_RU/collection-C000347-vintage/woven-wood'
            ]
        ],
        '/ru_RU/collection-C000948-holiday' => [
            'name' => 'HOLIDAY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Holiday.jpg',
            'alias' => 'холидэй',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-promenade',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-perenean',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-disco',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-christmas',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/pine-rendezvous',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-weekend',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/honeymoon',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/golf',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-friday',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-hobby',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-romantic',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-sunny',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-fiord',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-family',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/oak-freeride',
                'https://www.tarkett.ru/ru_RU/collection-C000948-holiday/bonifacio'
            ]
        ],
        '/ru_RU/collection-C000949-robinson' => [
            'name' => 'ROBINSON',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Robinson.jpg',
            'alias' => 'робинсон',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/abate-pear-tree',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/burma-teak',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/congolese-panga-panga',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/fir-alpine',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/grand-magnolia-tree',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/mahagony',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/merbau',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/jatoba',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/new-world-walnut',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/patchwork-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/oak-nebraska',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/patchwork-dark-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/patchwork-light-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/patchwork-olive',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/pine-himalayas',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/seagrass-zen',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/spirit-white',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/tanzanian-wenge',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/teak-badami',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/teak-ellora',
                'https://www.tarkett.ru/ru_RU/collection-C000949-robinson/shestnut-japanise'
            ]
        ],
        '/ru_RU/collection-C000953-estetica' => [
            'name' => 'ESTETICA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Estetica.jpg',
            'alias' => 'эстетика',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-grisaille',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-tarragon',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-danvile-yellow',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-danville-white',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-honey',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-chestnut',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-light-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-effect-light-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-natur-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-natur-dark-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-natur-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-natur-light-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-natur-white',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-select-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/oak-select-dark-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/sfumato',
                'https://www.tarkett.ru/ru_RU/collection-C000953-estetica/tempera'
            ]
        ],
        '/ru_RU/collection-C000958-odyssey' => [
            'name' => 'ODYSSEY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Odyssey.jpg',
            'alias' => 'одиссей',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-argos',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-fest',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-knoss',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-milet',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-olynf',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-pirey',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-rodes',
                'https://www.tarkett.ru/ru_RU/collection-C000958-odyssey/oak-tresa'
            ]
        ],
        '/ru_RU/collection-C000961-universe' => [
            'name' => 'UNIVERSE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Univers.jpg',
            'alias' => 'юниверс',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/altair',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/andromeda',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/cassiopeia',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/centaurus',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/eridanus',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/fortuna',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/hartley',
                'https://www.tarkett.ru/ru_RU/collection-C000961-universe/orion'
            ]
        ],
        '/ru_RU/collection-C000877-navigator' => [
            'name' => 'NAVIGATOR',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Navigator.jpg',
            'alias' => 'навигатор',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/berton',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/marco-polo',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/bosphorus',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/bering',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/columbus',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/hudson',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/gulf-stream',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/gibraltar',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/la-manche',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/martaban',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/livingstone',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/magellan',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/barentsz',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/spencer',
                'https://www.tarkett.ru/ru_RU/collection-C000877-navigator/vespucci'
            ]
        ],
        '/ru_RU/collection-C000878-pilot' => [
            'name' => 'PILOT',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Pilot.jpg',
            'alias' => 'пилот',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/bastie',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/bombardier',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/brown',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/cayley',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/coleman',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/earhart',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/doolittle',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/crossfield',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/farman',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/lindbergh',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/laroche',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/otto',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/warner',
                'https://www.tarkett.ru/ru_RU/collection-C000878-pilot/wright'
            ]
        ],
        '/ru_RU/collection-C001095-gallery' => [
            'name' => 'GALLERY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Gallery.jpg',
            'alias' => 'галерея',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/botticelli',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/caravaggio',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/cezanne',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/da-vinci',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/dali',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/monet',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/greco',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/degas',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/picasso',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/rembrandt',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/renoir',
                'https://www.tarkett.ru/ru_RU/collection-C001095-gallery/rubens'
            ]
        ],
        '/ru_RU/collection-C001378-dynasty' => [
            'name' => 'DYNASTY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Dynasty.jpg',
            'alias' => 'династия',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/bourbon',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/lancaster',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/romanov',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/stuart',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/tudor',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/valois',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/windsor',
                'https://www.tarkett.ru/ru_RU/collection-C001378-dynasty/york'
            ]
        ],
        '/ru_RU/collection-C001380-regata' => [
            'name' => 'REGATA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Regata.jpg',
            'alias' => 'регата',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/eclipse',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/enigma',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/moonlight',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/nero',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/pacific',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/palladium',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/serene',
                'https://www.tarkett.ru/ru_RU/collection-C001380-regata/topaz'
            ]
        ],
        '/ru_RU/collection-C001679-pervaya-uralskaya' => [
            'name' => 'ПЕРВАЯ Уральская',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_TAIGA_PERVAYA_Uralskaya.jpg',
            'alias' => 'первая-уральская',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-bezhevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-zolotoy',
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-korichnevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-svetlo-korichnevyy',
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-svetlyy',
                'https://www.tarkett.ru/ru_RU/collection-C001679-pervaya-uralskaya/dub-severnyy'
            ]
        ],
        '/ru_RU/collection-C000946-bogatyr' => [
            'name' => 'БОГАТЫРЬ',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Bogatyr.jpg',
            'alias' => 'богатырь',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000946-bogatyr/dakota-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000946-bogatyr/dublin-grey-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000946-bogatyr/palace-oak'
            ]
        ],
        '/ru_RU/collection-C000950-woodstock-family' => [
            'name' => 'WOODSTOCK FAMILY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Woodstock.jpg',
            'alias' => 'вудсток-фэмили',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/beige-sherwood-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/deep-honey-sherwood',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/mocha-sherwood-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-frisbee',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-lorien-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-robin-brown',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-parkour',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-noble-light',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-robin-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-misty-lux',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-segway',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/oak-snow-lux',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/princess-fontaineble-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/suede-sherwood-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/tobacco-sherwood-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000950-woodstock-family/white-sherwood-oak'
            ]
        ],
        '/ru_RU/collection-C000957-germany' => [
            'name' => 'GERMANY',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Germany.jpg',
            'alias' => 'германия',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/bremen',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/dresden',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/hamburg',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/hannover',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/keln',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/munich',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/oak-bonn',
                'https://www.tarkett.ru/ru_RU/collection-C000957-germany/oak-leipzig'
            ]
        ],
        '/ru_RU/collection-C000962-france' => [
            'name' => 'FRANCE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_France_Normandy.jpg',
            'alias' => 'франция',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/brittany',
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/burgundy',
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/champagne',
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/corsica',
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/normandy',
                'https://www.tarkett.ru/ru_RU/collection-C000962-france/pyrenees'
            ]
        ],
        '/ru_RU/collection-C001379-gallery-mini' => [
            'name' => 'Gallery MINI',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Gallery_mini.jpg',
            'alias' => 'галерея-мини',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/botticelli-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/caravaggio-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/cezanne-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/da-vinci-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/dali-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/monet-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/greco-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/degas-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/picasso-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/renoir-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/rembrandt-s',
                'https://www.tarkett.ru/ru_RU/collection-C001379-gallery-mini/rubens-s'
            ]
        ],
        '/ru_RU/collection-C001381-vernissage' => [
            'name' => 'VERNISSAGE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Vernissage.jpg',
            'alias' => 'верниссаж',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/becker',
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/capa',
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/erwitt',
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/evans',
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/fenton',
                'https://www.tarkett.ru/ru_RU/collection-C001381-vernissage/newton'
            ]
        ],
        '/ru_RU/collection-C000945-dubart' => [
            'name' => 'DUBART',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_DubArt.JPG',
            'alias' => 'дюбарт',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/canyon-castel-oak',
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/oak-provence-aged',
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/oak-victorian',
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/oak-fusion-easy',
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/oak-naturel-light',
                'https://www.tarkett.ru/ru_RU/collection-C000945-dubart/palace-oak'
            ]
        ],
        '/ru_RU/collection-C000951-intermezzo' => [
            'name' => 'INTERMEZZO',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Intermezzo.jpg',
            'alias' => 'интермеццо',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-avignon-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-avignon-grey',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-sonata-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-sonata-light-beige',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-sonata-white',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-tango-light',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-tango-honey',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-tango-dark',
                'https://www.tarkett.ru/ru_RU/collection-C000951-intermezzo/oak-tango-beige',
            ]
        ],
        '/ru_RU/collection-C000956-cinema' => [
            'name' => 'CINEMA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Cinema.jpg',
            'alias' => 'синема',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/astaire',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/audrey',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/bergman',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/bogart',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/brando',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/douglas',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/dietrich',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/brigitte',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/garland',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/grant',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/gable',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/hayworth',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/loren',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/merlin',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/taylor',
                'https://www.tarkett.ru/ru_RU/collection-C000956-cinema/vivien'
            ]
        ],
        '/ru_RU/collection-C000963-paris' => [
            'name' => 'PARIS',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Paris_eifel.jpg',
            'alias' => 'париж',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/bourbon',
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/eiffel',
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/marais',
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/montmartre',
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/montparnasse',
                'https://www.tarkett.ru/ru_RU/collection-C000963-paris/pompidou'
            ]
        ]
    ];

    private static $linksOfParket = [
        '/ru_RU/collection-C000971-tango-vintage' => [
            'name' => 'TANGO VINTAGE',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Tango_vintage.jpg',
            'alias' => 'танго-винтаж',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/dub-baden-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/dub-portu-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/dub-provans-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/dub-toskana-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/dub-shampan-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/yasen-andalusiya-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000971-tango-vintage/yasen-bordo-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000972-tango-classic' => [
            'name' => 'TANGO CLASSIC',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Tango_classic.jpg',
            'alias' => 'танго-классик',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-copper-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-imbirnyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-kottedzh-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-mindalnyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-svetlyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-sepiya-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/dub-siena-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/yasen-yasen-alebastr-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000972-tango-classic/yasen-yasen-osobyy-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000975-step-xl-l' => [
            'name' => 'STEP XL & L',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Step.jpg',
            'alias' => 'step-xl-&-l',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-koral-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-koral-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-royal-seryy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-royal-lazurnyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-royal-antik-belyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-polyarnyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-temnyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-siena-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-rustik-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-mednyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/yasen-pesochnyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/yasen-mokka-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-royal-seryy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-mednyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000975-step-xl-l/dub-baron-koral-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000979-europlank' => [
            'name' => 'EUROPLANK',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Europlank.jpg',
            'alias' => 'europlank',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-coffee-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-cream-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-honey-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-natural-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-original-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/dub-white-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/yasen-cocoa-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000979-europlank/yasen-mokka-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000981-europlank-hl' => [
            'name' => 'EUROPLANK HL',
            'image' => 'https://media.tarkett-image.com/medium/IN_Europlank_HL.jpg',
            'alias' => 'europlank-hl',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000981-europlank-hl/antre',
                'https://www.tarkett.ru/ru_RU/collection-C000981-europlank-hl/plombir',
                'https://www.tarkett.ru/ru_RU/collection-C000981-europlank-hl/polo',
                'https://www.tarkett.ru/ru_RU/collection-C000981-europlank-hl/tumannyy'
            ]
        ],
        '/ru_RU/collection-C000988-klassika-country' => [
            'name' => 'Klassika Country',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Klassika_Country_Oak_White.jpg',
            'alias' => 'klassika-country',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000988-klassika-country/dub-kantri-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000988-klassika-country/dub-kantri-belyy-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C001108-timber' => [
            'name' => 'TIMBER',
            'image' => 'https://media.tarkett-image.com/medium/IN_Timber_Oak_Wave.jpg',
            'alias' => 'timber',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/dub-wave-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/dub-klassik-glyancevyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/dub-svetlo-seryy-glyancevyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/dub-tenistyy-seryy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/krasnyy-dub-medovyy-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/krasnyy-dub-mokko-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/yasen-belyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/yasen-dymchatyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001108-timber/yasen-temno-korichnevyy-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C001386-ideo' => [
            'name' => 'IDEO',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Ideo_Oak_Nature.jpg',
            'alias' => 'ideo',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-beige-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-cream-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-grey-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-light-brown-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-nature-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001386-ideo/dub-white-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000965-salsa-premium' => [
            'name' => 'SALSA PREMIUM',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Salsa_premium.jpg',
            'alias' => 'salsa-premium',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-agat-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-imbirnyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-laymstoun-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-lunnyy-kamen-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-mramor-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-serdolik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-topaz-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/dub-yashma-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/yasen-kvarc-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/yasen-kristall-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000965-salsa-premium/yasen-opal-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000967-salsa-art-vision' => [
            'name' => 'SALSA ART VISION',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Salsa_art_vision.jpg',
            'alias' => 'salsa-art-vision',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-chocolate-sensation-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-gold-dust-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-grey-barn-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-morocco-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-sugar-cinnamon-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/dub-white-lightning-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/yasen-ivory-dreams-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/yasen-the-bronze-age-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/yasen-true-blue-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000967-salsa-art-vision/yasen-violet-hill-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000968-performance-fashion' => [
            'name' => 'PERFORMANCE FASHION',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_PERFORMANCE_FASHION.jpg',
            'alias' => 'performance-fashion',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-salvatore-eccentric-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-paco-new-look-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-salvatore-shine-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-salvatore-grunge-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-salvatore-style-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-gianni-boho-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-vivienne-new-look-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-vivienne-grunge-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-vivienne-eccentric-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-coco-shine-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-coco-elegance-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-coco-boho-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-gianni-eccentric-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-gianni-style-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-louis-eccentric-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-louis-elegance-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-louis-new-look-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-nina-black-out-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-nina-elegance-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000968-performance-fashion/dub-nina-new-look-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000970-tango-art' => [
            'name' => 'TANGO ART',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Tango_art.jpg',
            'alias' => 'tango-art',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/dub-amber-johannesbourg-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/dub-grey-rome-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/dub-violet-tokyo-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/dub-white-moscow-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/yasen-beige-lisbon-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/yasen-brown-barcelona-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000970-tango-art/yasen-pearl-dubai-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C001328-ingenio-parquet' => [
            'name' => 'Ingenio Parquet',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_INGENIO_Parquet.jpg',
            'alias' => 'ingenio-parquet',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001328-ingenio-parquet/dub-alyaska-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001328-ingenio-parquet/dub-zolotoy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001328-ingenio-parquet/dub-nordik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001328-ingenio-parquet/dub-seryy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001328-ingenio-parquet/dub-yarkiy-brash-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C001329-ingenio-plank' => [
            'name' => 'Ingenio Plank',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_INGENIO_PLANK.jpg',
            'alias' => 'ingenio-plank',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001329-ingenio-plank/dub-latte-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001329-ingenio-plank/dub-snezhnyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001329-ingenio-plank/dub-espresso-brash-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000964-salsa' => [
            'name' => 'SALSA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Salsa.jpg',
            'alias' => 'salsa',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/amerikanskiy-oreh-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/afrikanskiy-mahagoni-mahogany-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-ayvori-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-aysberg-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-vintazh-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-duo-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-kremovyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-korichnyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-kokua-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-mednyy-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-natur-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-natur-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-nordik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-premium-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-robust-belyy-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-rustik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-selekt-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-shokolad-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/dub-yava-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/merbau-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-arktik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-belyy-shelk-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-konyak-glyanec-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-muskatnyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-natur-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000964-salsa/yasen-tiramisu-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000966-salsa-art' => [
            'name' => 'SALSA ART',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Salsa_ART.jpg',
            'alias' => 'salsa-art',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/dub-chilled-cream-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/dub-moon-river-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/dub-shades-of-grey-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/dub-vanila-clouds-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/dub-white-wedding-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/yasen-beige-sunshine-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/yasen-cream-rhapsody-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/yasen-touch-of-grey-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/yasen-white-pearl-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000966-salsa-art/yasen-white-canvas-3-polosnyy'

            ]
        ],
        '/ru_RU/collection-C000969-tango' => [
            'name' => 'TANGO',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Tango.jpg',
            'alias' => 'tango',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/afrikanskiy-mahagoni-mahogany-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-mokko-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-antik-belyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-antik-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-baron-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-modern-seryy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-lazurnyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-burbon-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-mednyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-savanna-premium-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-tmin-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-shvarcvald-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/dub-yava-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/yasen-konyak-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000969-tango/yasen-konyak-brash-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000974-samba' => [
            'name' => 'SAMBA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Samba.jpg',
            'alias' => 'samba',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-antik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-arktik-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-biskvit-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-brendi-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-vanilla-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-premium-dizayn-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-natur-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-medovyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/dub-kremovyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/yasen-brendi-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/yasen-dymchatyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/yasen-kokua-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/yasen-misti-belyy-brash-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000974-samba/yasen-yantar-brash-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000976-bolero' => [
            'name' => 'BOLERO',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Bolero_Ash_Cognac_Grey.jpg',
            'alias' => 'bolero',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000976-bolero/yasen-antracit-brash-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000977-europarquet' => [
            'name' => 'EUROPARQUET',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Sinteros_Europarquet.jpg',
            'alias' => 'europarquet',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/buk-shokolad-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-oridzhnl-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-bezhevyy-maslo-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-bronzovyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-zolotoy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-polyarnyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-seryy-maslo-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-frost-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-espresso-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/dub-yantar-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000977-europarquet/yasen-nordik-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000986-klassika' => [
            'name' => 'KLASSIKA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Klassika_Ash_Natur.jpg',
            'alias' => 'klassika',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000986-klassika/buk-klassika-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000986-klassika/yasen-yasen-klassika-3-polosnyy'
            ]
        ],
        '/ru_RU/collection-C001614-timber-plank' => [
            'name' => 'TIMBER PLANK',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Timber_Plank_Oak_Buran.jpg',
            'alias' => 'timber-plank',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-briz-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-buran-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-zefir-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-musson-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-sandauner-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-tornado-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-tramontana-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C001614-timber-plank/dub-uragan-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000973-rumba' => [
            'name' => 'RUMBA',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Rumba.jpg',
            'alias' => 'rumba',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-aysberg-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-lava-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-mednyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-parkovyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-pesochnyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-skandinavskiy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-savanna-premium-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/dub-snezhnyy-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/yasen-kamen-brash-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/yasen-peshchernyy-1-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000973-rumba/yasen-morskoy-brash-1-polosnyy'
            ]
        ],
        '/ru_RU/collection-C000982-eurostandard' => [
            'name' => 'EUROSTANDARD',
            'image' => 'https://media.tarkett-image.com/medium/IN_TEE_Eurostandard.jpg',
            'alias' => 'eurostandard',
            'products' => [
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-classic-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-coffee-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-antre-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-antre-maslo-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-zimniy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-plyazhnyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/dub-tumannyy-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/yasen-cream-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/yasen-antik-3-polosnyy',
                'https://www.tarkett.ru/ru_RU/collection-C000982-eurostandard/yasen-kashtan-3-polosnyy'
            ]
        ]
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(count(self::$linksOfParket));
        $bar->start();

        foreach (self::$linksOfParket as $value) {
            $this->parseCollection($value);
            $bar->advance();
        }

        $bar->finish();

        $this->line('');

        $this->info('Well done!');

        return true;
    }

    /**
     * @param array $meta
     * @throws \Exception
     */
    private function parseCollection(array $meta): void
    {
        $catalog = new Catalog();
        $catalog->parent_id = 61;
        $catalog->name = $meta['name'];
        $catalog->alias = $meta['alias'];
        $catalog->title = $catalog->name . ' | море-ламината.рф';
        $catalog->description = $catalog->name . ', выгодные предложения для Вас.';

        if (!Catalog::whereAlias($catalog->alias)->exists() && $catalog->save()) {

            $imageNew = explode('/', $meta['image']);

            $imagName = Str::random(40);

            $ext = explode('.', end($imageNew));

            $path = Storage::path('public/test_items') . '/' . $imagName . '.' . end($ext);

            if (File::copy($meta['image'], $path)) {
                $newImage = new Image();
                $newImage->path = '/storage/images/' . $imagName . '.' . end($ext);
                $newImage->imageable_type = Catalog::class;
                $newImage->imageable_id = $catalog->id;
                $newImage->alt = $catalog->name;
                $newImage->save();
            }

            foreach ($meta['products'] as $product) {
                $this->parseProduct($product, $catalog->id);
            }
        }

        //$this->info('Категория ' . $catalog->name . ' успешно создана');
    }

    /**
     * @param string $link
     * @param int $catalogId
     * @throws \Exception
     */
    private function parseProduct(string $link, int $catalogId): void
    {
        $document = file_get_contents($link);

        $crawler = new Crawler($document);

        $newProduct = new CatalogProduct();
        $newProduct->catalog_id = $catalogId;
        $newProduct->name = trim($crawler->filter('h1')->first()->text());
        $newProduct->title = $newProduct->name . ' | море-ламината.рф';
        $newProduct->description = $newProduct->name . ', выгодные предложения для Вас.';
        $newProduct->price = 0;

        $newProduct->alias = mb_strtolower(str_replace([' ', '\''], '-', trim($newProduct->name)));
        while (CatalogProduct::where('alias', $newProduct->alias)->exists()) {
            $newProduct->alias .= '-' . random_int(1,350);
        }

        $newProduct->text = $crawler->filter('.information__characteristics')->first()->html();

        $image = $crawler->filter('.collection-product__header__images .hero__thumbnail.slide__image-container')->first()->attr('style');

        preg_match('/url\(.*\)/', $image, $matches);

        if ($matches) {
            $image = str_replace(['(',')','url'], '', $matches[0]);
        }

        if ($newProduct->save() && $image) {

            $name = Str::random(40);

            $imageNew = explode('/', $image);

            $ext = explode('.', end($imageNew));

            $path = Storage::path('public/test_items') . '/' . $name . '.' . end($ext);

            if(File::copy(self::DOMAIN . $image, $path)) {
                $newImage = new Image();
                $newImage->path = '/storage/images/' . $name . '.' . end($ext);
                $newImage->imageable_type = CatalogProduct::class;
                $newImage->imageable_id = $newProduct->id;
                $newImage->alt = $newProduct->name;

                $newImage->save();
            }
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
