<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
  0 => [
    'name' => 'Holly Black',
    'slug' => 'holly-black',
    'bio' => 'Holly Black is the #1 New York Times bestselling author of fantasy books, including the novels of Elfhame, The Coldest Girl in Coldtown, and The Spiderwick Chronicles. Her books have been translated into thirty-two languages worldwide and adapted for film.',
    'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Holly_Black_Author_Photo_2020.jpg/500px-Holly_Black_Author_Photo_2020.jpg',
    'website' => 'https://blackholly.com',
    'is_active' => true,
    'rating' => 4.2,
  ],
  1 => [
    'name' => 'Sarah J. Maas',
    'slug' => 'sarah-j-maas',
    'bio' => 'Sarah J. Maas je americká autorka, považovaná za jednu z hlavných tvárí romantasy – žánru, ktorý spája epickú fantasy s hlbokými romantickými dejovými líniami. Jej knihy ponúkajú dynamickú akciu, magické svety a komplexné vzťahy, ktoré často skúmajú lásku, straty a osobný rast postáv. Vďaka virálnemu fenoménu na BookToku a sociálnych sieťach si jej tvorba získala masový kultúrny dosah, a Sarah J. Maas sa tak stala ikonou moderného romantasy.',
    'photo' => 'https://cdn.albatrosmedia.sk/Images/Author/12026786/?width=300&height=450&ts=638826578250370000',
    'website' => 'https://sarahjmaas.com/',
    'is_active' => true,
    'rating' => 4.5,
  ],
  2 => [
    'name' => 'J.K. Rowling',
    'slug' => 'j-k-rowling',
    'bio' => 'J.K. Rowling (nar. 1965) je britská spisovateľka, známa sériou Harry Potter, ktorá sa stala globálnym fenoménom. Sedemdielna sága (1997 – 2007) sa predala v stovkách miliónov výtlačkov a bola adaptovaná do ôsmich úspešných filmov. Svet Harryho Pottera rozšírila o Fantastické zvery a ich výskyt, Metlobal v priebehu vekov a Rozprávky Barda Beedla. Pod pseudonymom Robert Galbraith píše detektívnu sériu o súkromnom detektívovi Cormoranovi Strikeovi. Pre dospelých vydala román Prázdne miesto (2012). Medzi jej ďalšie diela patrí rozprávka Ikabog (2020) a Vianočné prasiatko (2021). Rowlingová sa venuje aj filantropii, najmä cez svoju nadáciu Volant. Je jednou z najúspešnejších spisovateliek súčasnosti.',
    'photo' => 'https://www.jkrowling.com/wp-content/uploads/2022/05/J.K.-Rowling-2021-Photography-Debra-Hurford-Brown-scaled.jpg',
    'website' => 'https://www.jkrowling.com/',
    'is_active' => true,
    'rating' => 4.8,
  ],
  3 => [
    'name' => 'J.R.R. Tolkien',
    'slug' => 'j-r-r-tolkien',
    'bio' => 'J. R. R. Tolkien (1892 – 1973) bol britský spisovateľ, filológ a univerzitný profesor, ktorý zásadne ovplyvnil modernú podobu fantasy literatúry. Pri tvorbe svojich príbehov vychádzal z hlbokej znalosti jazykov a mytológie, vďaka čomu jeho svet Stredozeme nepôsobí ako bežná fikcia, ale ako premyslený historický univerzum s vlastnými dejinami a kultúrami.',
    'photo' => 'https://www.booxy.sk/authors/j-r-r-tolkien-53782.jpg',
    'website' => NULL,
    'is_active' => false,
    'rating' => 4.9,
  ],
  4 => [
    'name' => 'Suzanne Collins',
    'slug' => 'suzanne-collins',
    'bio' => 'Suzanne Collins sa na začiatku kariéry venovala televíznej tvorbe pre deti. Stretnutie so spisovateľom Jamesom Proimosom ju inšpirovalo k písaniu pôvodnej literatúry pre mládež. Popularitu získala vďaka sérii kníh o chlapcovi Gregorovi, ktorý sa podobne ako Alica v krajine zázrakov prepadne do podzemia, ibaže jeho príhody sú oveľa nebezpečnejšie. Suzanne Collins žije s rodinou v Connecticute..',
    'photo' => 'https://www.suzannecollinsbooks.com/images/suzannecollins-2020-photocredittoddplitt.jpg',
    'website' => 'https://www.suzannecollinsbooks.com/',
    'is_active' => true,
    'rating' => 4.3,
  ],
  5 => [
    'name' => 'Veronica Roth',
    'slug' => 'veronica-roth',
    'bio' => 'Americká autorka známa vďaka trilógii Divergent. Už jej prvé dve časti (Divergent, Insurgent) sa hneď po uvedení na knižný trh stali bestsellermi.',
    'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-8qpzk0kMbT24q43TkUw57pxDJXH1ZWGc6FVw2IRZkNNrdxOYGXO_Vnt9lOu98e3ybVF5y673_ARekx21QL2wGcxGg45TKq1eGRQJBQ&s=10',
    'website' => 'https://veronicarothbooks.com/',
    'is_active' => true,
    'rating' => 4.1,
  ],
  6 => [
    'name' => 'Lynn Painter',
    'slug' => 'lynn-painter',
    'bio' => 'Lynn Painter is the author of Better Than The Movies. She writes romantic comedies for tweens, teens, and adults, and when she isn\'t reading or writing, odds are good she’s guzzling energy drinks and watching rom-coms.',
    'photo' => 'https://festivalofauthors.ca/wp-content/uploads/2024/08/Painter-Lynn_credit-Jackson-Okun-Headshot_square.jpg',
    'website' => 'https://lynnpainter.com/about',
    'is_active' => true,
    'rating' => 4.0,
  ],
  7 => [
    'name' => 'Antoine de Saint-Exupéry',
    'slug' => 'antoine-de-saint-exupery',
    'bio' => 'Antoine de Saint-Exupéry sa narodil v Lyone ako jedno z piatich detí. Už od detstva ho fascinovali stroje, hlavne lokomotívy a lietadlá a všetko, čo s nimi súvisí. Po dvoch rokoch štúdia architektúry nastúpil v roku 1921 do vojenskej služby do leteckého pluku. Od tejto chvíle je jeho život spätý priamo alebo nepriamo s vojenským a civilným letectvom.
 Po získaní skúseností vo Francúzsku pôsobí ako riaditeľ leteckej spoločnosti v Argentíne a organizuje priekopnícke lety s poštovými zásielkami ponad Kordillery: sám tu otvára nočnú prevádzku. Osobný nepokoj mu nedovoľuje zostávať dlhšiu dobu na jednom mieste, a tak často mení pôsobisko. Pokúša sa o priamy let z Paríža do Saigonu a v roku 1935 zažíva svoju azda nejväčšiu životnú haváriu, keď musí núdzovo pristáť 200 kilometrov od Káhiry a je s radistom Prévotom zachránený karavánou až po piatich dňoch blúdenia púšťou celkom vyčerpaný.
V roku 1938 pri núdzovom pristání iba zázrakom unikne smrti - z následkov početných zlomenín lebky sa však už nikdy celkom nezotaví. V roku 1939 nastupuje opäť ku svojej letke. Napriek nepriaznivému zdravotnému posudku dosiahne, že ako kapitán plní nebezpečné úlohy leteckého prieskumu. Po porážke Francúzska odchádza do Spojených štátov. Píše knihy a neustále usiluje o nové vojenské nasadenie. Až na základe intervencie Rooseveltovho syna môže opäť odísť k svojej letke a prejsť školením na nových strojoch.
 31. 7. 1944 vzlietol ku svojmu ôsmemu a poslednému prieskumnému letu, ku ktorému získal špeciálny súhlas – vzhľadom k jeho veku mu bylo povolených iba päť letov. Z tohto letu sa však nikdy nevrátil. Jeho telo ani zvyšky jeho lietadla se nikdy nenašli a tento pozoruhodný spisovateľ prvej polovice našeho storočia a svojrázny filozof zmizol vo vodách Korzického prielivu, pravdepodobne zostrelený nemeckou stíhačkou.',
    'photo' => 'https://image.pmgstatic.com/cache/resized/w936/files/images/film/photos/161/601/161601835_f34811.jpg',
    'website' => NULL,
    'is_active' => false,
    'rating' => 4.7,
  ],
  8 => [
    'name' => 'Dan Brown',
    'slug' => 'dan-brown',
    'bio' => 'Dan Brown (február 1964, New Hampshire) je americký spisovateľ trilerov a autor svetových bestsellerov, vrátane Da Vinciho kódu a série o Robertovi Langdonovi. Jeho knihy spájajú historické záhady, tajné spoločnosti, modernú vedu a náboženstvo. Debutoval románom Digitálna pevnosť a preslávila ho tiež kniha Anjeli a démoni. Spomínaný Da Vinciho kód sa stal fenomenálnym bestsellerom a bol sfilmovaný s Tomom Hanksom. Brown patrí medzi najúspešnejších autorov historických a náboženských trilerov súčasnosti. Po dlhšej pauze sme sa však dočkali novej knihy Dana Browna - Posledné tajomstvo, ktorá je pokračovaním úspešnej série Robert Langdon.',
    'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIbBnWTRyvmc9UKzQNCK5MD_WNydwhS-nLqw&s',
    'website' => 'https://danbrown.com/',
    'is_active' => true,
    'rating' => 4.2,
  ],
  9 => [
    'name' => 'Rebecca Yarros',
    'slug' => 'rebecca-yarros',
    'bio' => 'Rebecca Yarros je medzinárodne uznávaná a bestsellerová autorka podľa rebríčkov New York Times, USA Today a Wall Street Journal. Preslávila sa najmä svojimi emocionálne silnými fantasy a new adult románmi. Napísala viac než dvadsať úspešných kníh vrátane svetových hitov Štvrtého krídla a Možno ťa znovu stretnem, ktoré si získali obrovskú čitateľskú základňu po celom svete. Za svoju tvorbu získala prestížne ocenenia, napríklad British Book Award za knihu roka či Alex Award od Americkej asociácie knižníc.',
    'photo' => 'https://shereads.com/wp-content/uploads/2025/02/3.jpg',
    'website' => 'https://rebeccayarros.com/',
    'is_active' => true,
    'rating' => 4.4,
  ],
  10 => [
    'name' => 'Jane Austen',
    'slug' => 'jane-austen',
    'bio' => 'Jane Austen (1775–1817) patrí medzi najvýznamnejšie anglické spisovateľky a klasické autorky rodinného románu. Jej knihy zachytávajú život vidieckej spoločnosti a predstavujú inteligentné, morálne pevné hrdinky, ktoré kontrastujú s povrchnosťou okolia. Medzi najznámejšie knihy Jane Austen patria román o spoločenských vzťahoch Pýcha a predsudok, jemne irónický Rozum a cit, prepracovaná štúdia charakterov Emma , rodinný príbeh Sídlo Mansfield či goticky ladené Opátstvo Northanger. Okrem toho napísala aj kratšie či nedokončené diela, ako strhujúci Lady Susan, nedokončený The Watsons a podnetný Sanditon. Knihy Jane Austen sú známe jemnou iróniou, presnou psychologickou kresbou postáv a hlbokým vhľadom do spoločenských vzťahov, a dodnes inšpirujú čitateľov aj divákov po celom svete.',
    'photo' => 'https://cdn.britannica.com/12/172012-050-DAA7CE6B/Jane-Austen-Cassandra-engraving-portrait-1810.jpg',
    'website' => NULL,
    'is_active' => false,
    'rating' => 4.6,
  ],
  11 => [
    'name' => 'Lauren Kate',
    'slug' => 'lauren-kate',
    'bio' => '(1981) vyrástla v Dallase. Do školy chodila v Atlante a písať začala v New Yorku. V súčasnosti žije v Los Angeles.',
    'photo' => 'https://images4.penguinrandomhouse.com/author/114069',
    'website' => 'http://laurenkatebooks.net/',
    'is_active' => true,
    'rating' => 0.0,
  ],
  12 => [
    'name' => 'Tahereh Mafi',
    'slug' => 'tahereh.mafi',
    'bio' => 'Tahereh Mafi is the #1 New York Times bestselling, #1 international best selling, and National Book Award nominated author of over a dozen novels. The second instalment in her new fantasy series, These Infinite Threads, is on shelves now.',
    'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNb9WtIoZgDNcAa3wQDlAAKQhNth7YQraVTwAjxAVa-eHrB-gh9teiu2ngxpbtb4-dyh7xJqq61vF0WjK0bUtwv6JeHLv3xFjoFtUk7kw&s=10',
    'website' => 'https://www.taherehmafi.com/',
    'is_active' => true,
    'rating' => 0.0,
  ],
  13 => [
    'name' => 'Stephanie Garber',
    'slug' => 'stephanie-garber',
    'bio' => 'Stephanie Garber is an American author of young adult fiction known for the Caraval and Once Upon a Broken Heart which were interconnected trilogies',
    'photo' => 'https://www.hachette.co.uk/wp-content/uploads/2019/04/contributor-stephanie-garber-1535.jpg',
    'website' => NULL,
    'is_active' => true,
    'rating' => 4.3,
  ],
];

        foreach ($authors as $authorData) {
            Author::updateOrCreate(
                ['slug' => $authorData['slug']],
                $authorData
            );
        }

        // Prepojenie existujúcich kníh s autormi podľa mena
        $books = Book::all();
        foreach ($books as $book) {
            $author = Author::where('name', $book->author)->first();
            if ($author) {
                $book->update(['author_id' => $author->id]);
            }
        }

        // Aktualizácia počtu kníh pre každého autora
        $allAuthors = Author::all();
        foreach ($allAuthors as $author) {
            $count = Book::where('author_id', $author->id)->count();
            $author->update(['book_count' => $count]);
        }
    }
}