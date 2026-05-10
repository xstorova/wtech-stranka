<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class BookSeeder extends Seeder {
    public function run() {
        Book::truncate();

        $books = [
  0 => [
    'title' => 'The Cruel Prince',
    'author' => 'Holly Black',
    'price' => 16.9,
    'discount' => 12,
    'description' => 'One terrible morning, Jude and her sisters see their parents murdered in front of them. The terrifying assassin abducts all three girls to the world of Faerie, where Jude is installed in the royal court but mocked and tormented by the Faerie royalty for being mortal. As Jude grows older, she realises that she will need to take part in the dangerous deceptions of the fey to ever truly belong. But the stairway to power is fraught with shadows and betrayal. And looming over all is the infuriating, arrogant and charismatic Prince Cardan.',
    'image' => 'https://mrtns.sk/tovar/_l/3670/l3670859.jpg?v=17779503072',
    'category' => 'Fantasy',
    'status' => 'active',
    'is_new' => true,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  1 => [
    'title' => 'Throne of Glass',
    'author' => 'Sarah J. Maas',
    'price' => 18.5,
    'discount' => 19,
    'description' => 'V krajine bez akejkoľvek mágie, kde vládne krutý kráľ, je na kráľovský dvor povolaná najnebezpečnejšia nájomná vrahyňa. Prichádza, aby získala späť svoju slobodu, nie aby zabila kráľa. Ak v turnaji porazí dvadsaťtri nájomných vrahov, zlodejov a žoldnierov, prepustia ju z väzenia a po štvorročnej službe ako kráľova šampiónka získa späť svoju slobodu.

Jej meno je Celaena Sardothien. Korunný princ si Celaenu na túto úlohu najal a je jej jediným spojencom. Kapitán kráľovskej gardy je zas jej pravým ochrancom. V komnatách a chodbách Zámku zo skla sa však schováva niečo oveľa nebezpečnejšie... A keď začne Celaeniných protivníkov niekto po jednom likvidovať, jej zápas o slobodu sa mení na boj o holé prežitie. Tajomný nepriateľ sa totiž neuspokojí, kým nebude ležať celý svet v troskách.',
    'image' => 'https://mrtns.sk/tovar/_l/179/l179883.jpg?v=17766609162',
    'category' => 'Fantasy',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  2 => [
    'title' => 'Harry Potter a Kameň mudrcov',
    'author' => 'J.K. Rowling',
    'price' => 12.99,
    'discount' => 0,
    'description' => 'Nadčasová sága o chlapcovi s neobyčajnými schopnosťami a jeho odvážnych priateľoch neustále fascinuje nielen deti, ale aj dospelých. Pri príležitosti 20. výročia vydania prvého príbehu vznikol špeciálny box a obálky jednotlivých kníh ilustroval veľký fanúšik svetoznámeho čarodejníka, slovenský ilustrátor Adrián Macho. Čitatelia majú teraz po niekoľkých rokoch od vydania boxu možnosť kúpiť si knihy so zrevidovaným prekladom aj jednotlivo.
Harry Potter nepočul o Rokforte nikdy predtým, ako do domu na Privátnej ceste číslo 4 začala prichádzať záhadná pošta. Listy napísané zeleným atramentom na pergamenovom papieri s purpurovou pečaťou však jeho príšerná teta a strýko rýchlo zničia. Onedlho, na Harryho jedenáste narodeniny, k nim vtrhne obor Rubeus Hagrid s očami ako dva chrobáčiky. Má ohromujúcu správu: Harry Potter je čarodejník a prijali ho na Rokfortskú strednú školu čarodejnícku. A tým sa začína neuveriteľné dobrodružstvo!',
    'image' => 'https://mrtns.sk/tovar/_l/2613/l2613775.jpg?v=17766604052',
    'category' => 'Fantasy',
    'status' => 'active',
    'is_new' => true,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'pre-deti',
    ],
  ],
  3 => [
    'title' => 'Pán prsteňov - Spoločenstvo prsteňa',
    'author' => 'J.R.R. Tolkien',
    'price' => 19.89,
    'discount' => 15,
    'description' => 'Tento príbeh narastal pri rozprávaní, až sa stal dejinami Veľkej vojny o Prsteň a obsahuje mnoho pohľadov do ešte starodávnejších dejín, ktoré mu predchádzali - napísal v predslove k druhému vydaniu J. R. R. Tolkien o tejto vari najznámejšej knižnej trilógii minulého storočia. Čarovný svet elfov a hobitov je paralelným svetom ""veľkých ľudí"". Jeho hlavnou témou je Prsteň ako ohnivko, ktoré ho púta k Hobitovi. Proti akýmkoľvek alegóriám sa autor bránil a všetky možné posolstvá a vnútorné významy spájané s jeho knihou sa mu zo srdca protivili. Preto je túto knihu potrebné chápať ako najobľúbenejšie dejiny pradávneho veku a nijako inak. Knihu preložil Otakar Kořínek.',
    'image' => 'https://mrtns.sk/tovar/_l/134/l134260.jpg?v=17766609162',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
    ],
  ],
  4 => [
    'title' => 'Hry o život',
    'author' => 'Suzanne Collins',
    'price' => 20.99,
    'discount' => 20,
    'description' => 'V postapokalyptickej Amerike sa každý rok konajú Hry o život. Neľútostná reality šou, v ktorej je dvanásť chlapcov a dvanásť dievčat nútených bojovať na život a na smrť. Šestnásťročná Katniss Everdeenová sa do Hier prihlási dobrovoľne namiesto svojej sestry. Zdá sa, že jej dni sú spočítané. Katniss je však na boj o prežitie zvyknutá. Zvíťaziť môže len jeden a Katniss je odhodlaná urobiť všetko pre to, aby sa vrátila domov.',
    'image' => 'https://mrtns.sk/tovar/_l/2837/l2837335.jpg?v=17766604052',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'sci-fi',
    ],
  ],
  5 => [
    'title' => 'Divergencia',
    'author' => 'Veronica Roth',
    'price' => 12.95,
    'discount' => 10,
    'description' => 'Chicago, ďaleká budúcnosť. Beatrice Priorová žije v spoločnosti rozdelenej na päť frakcií. Na rozhodovacej ceremónii si všetci šestnásťroční vyberajú frakciu, ktorej zasvätia zvyšok života. Beatrice má len dve možnosti: zostať so svojou rodinou, alebo ju navždy opustiť, aby mohla byť sama sebou. Rozhodnutím napokon prekvapí všetkých vrátane seba. Zmení si meno na Tris a usiluje sa obstáť v tvrdej konkurencii, aby si vybojovala miesto v novom živote. Hľadá skutočných priateľov a zamotáva sa do vzťahu s chvíľami neodolateľným, inokedy neznesiteľným chlapcom. Keď Tris objaví sprisahanie, ktoré môže zničiť jej navonok dokonalú spoločnosť, záhadná schopnosť jej buď pomôže zachrániť ľudí, ktorých miluje, alebo...',
    'image' => 'https://mrtns.sk/tovar/_l/114/l114860.jpg?v=17766609162',
    'category' => 'Beletria',
    'status' => 'inactive',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'sci-fi',
    ],
  ],
  6 => [
    'title' => 'Mr Wrong Number',
    'author' => 'Lynn Painter',
    'price' => 13.9,
    'discount' => 0,
    'description' => 'Bad luck has always followed Olivia. But when a steamy text from a random number turns into the most entertaining relationship of her life, it seems things are looking up.
Colin has always considered Olivia his flatmate\'s annoying little sister. Until she moves in with them, and he realises she\'s turned into an altogether sexier distraction...
He\'s determined to keep his distance, but it isn\'t easy. Especially when he discovers she\'s the girl he\'s been secretly messaging.
Now, Mr Wrong Number must decide. Should he shut down the messages, before things get messy?
Or turn up the heat... ?',
    'image' => 'https://mrtns.sk/tovar/_xl/1617/xl1617829.jpg?v=17766604162',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'romantika',
    ],
  ],
  7 => [
    'title' => 'Malý princ',
    'author' => 'Antoine de Saint-Exupéry',
    'price' => 5.0,
    'discount' => 0,
    'description' => 'Pôvabná knižka nielen pre deti, ale pre všetkých, ktorí chcú deťom porozumieť. Toto dielko dosiahlo svetový úspech a dnes patrí do základného fondu svetovej literatúry. Jeho hodnota a krása nespočíva len v peknom rozprávkovom príbehu, ale hlavne v myšlienkach, ktoré ako vzácne kamienky vytvárajú obraz tých najkrajších ľudských vlastností...
Knižka vychádza v novom preklade.',
    'image' => 'https://mrtns.sk/tovar/_l/3395/l3395581.jpg?v=17766715842',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'pre-deti',
      3 => 'klasika',
    ],
  ],
  8 => [
    'title' => 'Da Vinciho kód',
    'author' => 'Dan Brown',
    'price' => 13.9,
    'discount' => 25,
    'description' => 'parížskom Louvri nájdu mŕtvolu muža a pri ňom záhadnú šifru v podobe pentagramu, pripomínajúcu najslávnejšiu kresbu Leonarda da Vinci. Americký vedec, odborník na symboliku Robert Langdon a pôvabná francúzska kryptologička Sophie sa podujmú záhadu rozlúštiť a začína sa ich dobrodružná misia plná vzrušujúcich a nebezpečných odhalení.

Zavraždený kurátor múzea bol, podobne ako mnohé významné osobnosti v dejinách, členom Priorstva Sionu, spoločenstva, ktorého poslaním je chrániť jedno z najväčších tajomstiev tohto sveta. Hrozí, že toto tajomstvo čoskoro môže vyjsť najavo, a tomu treba za každú cenu zabrániť, pretože následky by mohli byť nepredstaviteľné. Vedecké bádanie sa tak dostáva do ostrého konfliktu so záujmami cirkvi aj s náboženským fanatizmom a v hre je odrazu všetko, aj holý život.',
    'image' => 'https://mrtns.sk/tovar/_l/148/l148928.jpg?v=17766609162',
    'category' => 'Detektívky',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'detektivky',
    ],
  ],
  9 => [
    'title' => 'Štvrté krídlo',
    'author' => 'Rebecca Yarros',
    'price' => 19.9,
    'discount' => 0,
    'description' => 'Dvadsaťročná Violet Sorrengailová mala vstúpiť do Pisárskeho kvadrantu a prežiť pokojný život medzi knihami a dejinami. Veliaca generálka a zhodou okolností aj jej tvrdohlavá matka ju však donútila zúčastniť sa na výbere medzi elitných dračích jazdcov. No ak ste útlejší a nižší než stovky ostatných kandidátov, smrť vám doslova dýcha na krk. Draci si totiž málokedy vyberajú "krehkých" ľudí. Tých pália na popol.

Keďže drakov, čo by si vybrali Violet, je ako šafranu, väčšina kadetov by ju najradšej zniesla zo sveta, len aby zvýšili vlastné šance. Pre iných, napríklad pre mocného a nemilosrdného veliteľa krídla v Jazdeckom kvadrante Xadena Riorsona, je tŕňom v oku Violetin pôvod.

Ak chce Violet prežiť, musí sa spoľahnúť na svoj dôvtip. S každým dňom je však vojna za hranicami akadémie čoraz krvavejšia, obrana kráľovstva zlyháva a počet mŕtvych narastá. Navyše sa zdá, že velitelia skrývajú hrôzostrašné tajomstvo.',
    'image' => 'https://mrtns.sk/tovar/_l/2210/l2210647.jpg?v=17766604092',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  10 => [
    'title' => 'Pride and Prejudice',
    'author' => 'Jane Austen',
    'price' => 8.9,
    'discount' => 0,
    'description' => 'A beautiful deluxe gift edition of Jane Austen’s masterpiece with foiled covers, marbled endpapers, sprayed edges, beautiful paper and finished with a silk ribbon.

When Elizabeth Bennet meets Mr Darcy, she is repelled by his overbearing pride and prejudice towards her family. But the Bennet girls are in need of financial security in the shape of husbands, so when Darcy’s friend, the affable Mr Bingley, forms an attachment to Jane, Darcy becomes increasingly hard to avoid. Polite society will be turned upside down in this witty drama of friendship, rivalry and love – Jane Austen’s classic romance novel.',
    'image' => 'https://mrtns.sk/tovar/_l/2778/l2778317.jpg?v=17763321622',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'romantika',
      2 => 'klasika',
    ],
  ],
  11 => [
    'title' => 'Pád',
    'author' => 'Lauren Kate',
    'price' => 7.0,
    'discount' => 30,
    'description' => 'Na Danielovi Grigorim je čosi bolestne známe. Tajomný, uzavretý chlapec pritiahne pozornosť sedemnásťročnej Luce Priceovej hneď v jej prvý deň na internátnej škole Meč a kríž pri meste Savannah. Je jediným svetlým bodom na mieste, kde nie sú dovolené mobilné telefóny, ostatní študenti sú vyšinutí a bezpečnostné kamery ich sledujú na každom kroku.

Daniel však nechce mať s Luce nič spoločné – a dáva jej to jasne najavo. No ona sa nevzdáva. Mládenec ju priťahuje ako svetlo nočného motýľa a Luce musí zistiť, čo pred ňou tak zúfalo skrýva... aj keby ju to malo stáť život. Nebezpečne vzrušujúci a temne romantický triler PÁD je súčasne najúžasnejším príbehom lásky!',
    'image' => 'https://mrtns.sk/tovar/_l/99/l99375.jpg?v=17766609082',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => '2026-04-21',
    'preorder_date' => '2026-04-24',
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  12 => [
    'title' => 'Skleněný trůn (exkluzivní vydání)',
    'author' => 'Sarah J. Maas',
    'price' => 15.19,
    'discount' => 0,
    'description' => 'Je jí 18 let a jmenuje se Celaena. Od dětství byla trénovaná k jedinému úkolu – stát se tím nejlepším zabijákem v Endovieru. Je však chycena a odsouzena k doživotnímu vězení. Aby získala zpět svoji svobodu, musí v turnaji na život a na smrt porazit ty nejobávanější zločince. Její soupeře ale ohrožuje něco tajemného a děsivého. Nelítostný boj na život a na smrt začíná…',
    'image' => 'https://mrtns.sk/tovar/_l/1626/l1626035.jpg?v=17776967882',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => true,
    'is_bestseller' => false,
    'published_at' => '2026-05-22',
    'preorder_date' => '2026-05-01',
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  13 => [
    'title' => 'Koruna z temnoty',
    'author' => 'Sarah J. Maas',
    'price' => 13.6,
    'discount' => 0,
    'description' => 'Boj o záchranu kráľovstva sa v románe Trón zo skla len začal. Koruna z temnoty je očakávané a napínavé pokračovanie jednej z najpopulárnejších fantasy sérii dneška! Osemnásťročná Celaena Sardothien je odvážna, statočná i krásna - dokonalá kombinácia pre najnebezpečnejšiu nájomnú vrahyňu a mladú dámu, ktorá dokáže zlomiť srdce nejedného muža. No aj keď porazila súperov v nezmyselnom kráľovom turnaji a stala sa jeho osobnou popravčou čatou, nezískala ani náznak slobody. Otročenie v soľných baniach bolo v porovnaní so službou kráľovi prechádzka ružovou záhradou. Kráľ, ktorý zo skleneného trónu vládne pevným žezlom, je totiž najzlovestnejším a neporaziteľným nepriateľom celého kráľovstva. Kráľovstvom otriasajú správy o vzburách otrokov a v uliciach Riftholdu sa šepká o povstaní.

Celaena dostane za úlohu vznikajúcu revolúciu krvavo potlačiť. Ale ako môže bojovať proti vzbúrencom, keď s nimi súhlasí? Pridá sa k povstalcom za cenu životov svojich najbližších? Neľútostná nájomná vrahyňa sa nezastaví pred ničím - ale kráľ Adarlanu tiež nie...',
    'image' => 'https://mrtns.sk/tovar/_l/179/l179885.jpg?v=17777204742',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  14 => [
    'title' => 'Zrodená z ohňa',
    'author' => 'Sarah J. Maas',
    'price' => 15.39,
    'discount' => 0,
    'description' => 'Tretí diel najúspešnejšej fantasy série súčasnosti Trón zo skla v hlavnej úlohe s najobávanejšou nájomnou vrahyňou Celaenou Sardothien!
Celaena sa už vysporiadala s nebezpečnými protivníkmi i so srdcom rozlámaným na márne kúsky. Teraz myslí len na pomstu, no ako kráľova šampiónka musí slúžiť podlému tyranovi, ktorý má všetko na svedomí. Kapitán kráľovskej gardy ju však vyšle do Wendlynu netušiac, že Celaenina minulosť aj budúcnosť sa skrýva práve v ďalekom kráľovstve férov. Pomoc férskej kráľovnej má však privysokú cenu...

Kým Celaena vo Wendlyne bojuje s démonmi minulosti, v Erilei sa na útok pripravujú nebezpečné sily. Chaol a Dorian sa púšťajú do boja s temnotou, akú nečakali ani v najhorších nočných morách. Obávané bosorky sa totiž spolčili s tyranským kráľom a krvilačná Manon sa nezastaví, kým pred ňou nebude celá Erilea kľačať na kolenách.

Ak dokáže Celaena prekonať samú seba, stane sa najväčšou hrozbou pre kráľa a jeho zem – ale aj pre seba. Nenechajte si ujsť najpopulárnejšiu fantasy sériu súčasnosti: Trón zo skla, Koruna z temnoty, Zrodená z ohňa... a nezabudnite na štyri exkluzívne novely k sérii Trón zo skla!',
    'image' => 'https://mrtns.sk/tovar/_l/224/l224523.jpg?v=17776968132',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  15 => [
    'title' => 'Kráľovná v tieňoch',
    'author' => 'Sarah J. Maas',
    'price' => 15.39,
    'discount' => 0,
    'description' => 'Štvrté pokračovanie najúspešnejšej fantasy série súčasnosti Trón zo skla.
Prečítaj a podľahni – séria Trón zo skla je aj tvoja nová závislosť.
Celaena sa vracia do nenávideného impéria. Aby sa pomstila. Aby zachránila svoje kedysi mocné kráľovstvo a postavila sa zoči-voči tieňom z minulosti. Odkedy akceptovala svoje férske dedičstvo, už nie je najobávanejšou nájomnou vrahyňou Celaenou Sardothien. Teraz je Aelin Galathynius, dedička terrasenského kráľovského trónu. No kým sa zmocní trónu, musí bojovať. Za svojho bratranca - bojovníka ochotného za ňu položiť vlastný život. Za svojho priateľa - mladíka spútaného v temnom väzení. A za svoj ľud zotročený surovým kráľom, za ľud očakávajúci návrat kráľovnej.

Komu sa kniha môže páčiť: Milovníkom fantasy literatúry, fanúšikom Sarah J. Maas či Cassandry Clare.',
    'image' => 'https://mrtns.sk/tovar/_l/242/l242506.jpg?v=17777033782',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  16 => [
    'title' => 'Búrka v impériu',
    'author' => 'Sarah J. Maas',
    'price' => 15.3,
    'discount' => 0,
    'description' => 'Piate pokračovanie najúspešnejšej tínedžerskej fantasy ságy súčasnosti. Prečítajte a podľahnite sérii Trón zo skla tak ako milióny čitateľov po celom svete!
Dlhá cesta na trón sa pre Aelin Galathynius ešte len začala. Prisahala však, že sa svojmu kráľovstvu už nikdy neotočí chrbtom. Hlavne, ak je jediná, kto dokáže zostaviť armádu proti Temnému kráľovi a jeho beštiám. No Erawan neohrozuje Aelin len svojím vojskom, ale aj tieňmi z jej minulosti, bývalými spojencami a nepriateľmi. Na obzore sa však črtá vojna nebývalých rozmerov a Aelin sa musí rozhodnúť, koho a čo obetuje, aby zachránila svoj svet pred úplným zničením.

Komu sa kniha môže páčiť: Sarah J. Maas prekonáva v každej časti samú seba. Máte sa znovu na čo tešiť!',
    'image' => 'https://mrtns.sk/tovar/_l/242/l242507.jpg?v=17777033782',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  17 => [
    'title' => 'Kráľovstvo z popola',
    'author' => 'Sarah J. Maas',
    'price' => 16.39,
    'discount' => 0,
    'description' => 'Dlhoočakávané finále jednej z najúspešnejších fantasy sérií, závislosti, ktorej prepadli čitatelia po celom svete, Trón zo skla!

Aelin Galathynius sa zaprisahala, že zachráni svoj ľud, aj keď cena, ktorú za to treba zaplatiť, je nepredstaviteľne vysoká. Keď ju kráľovná férov Maeve uväzní v starodávnej železnej truhle a niekoľko mesiacov mučí, jedinou nádejou na prežitie je len Aelinina ohnivá vôľa a strašná istota, že ak ju Maeve zlomí, bude to znamenať skazu pre jej milovaných. S každým ďalším dňom však jej pevné odhodlanie nepoddať sa čoraz viac slabne... Kým je Aelin v zajatí, jej priateľov a spojencov osud zaveje na všetky svetové strany. Niektoré putá sa posilnia, iné sa spretŕhajú naveky. A keď sa ich cesty znovu spoja, všetci musia bojovať, ak Erilea nemá padnúť.
V napínavom záverečnom diele svetového bestselleru od Sarah J. Maas bude musieť Aelin zviesť posledný, najťažší boj pre záchranu seba samej – a pre prísľub lepšieho sveta.

Komu sa kniha môže páčiť: Milovníkom fantasy literatúry, fanúšikom Sarah J. Maas či Cassandry Clare.',
    'image' => 'https://mrtns.sk/tovar/_l/278/l278146.jpg?v=17777033782',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  18 => [
    'title' => 'Veža na úsvite',
    'author' => 'Sarah J. Maas',
    'price' => 15.4,
    'discount' => 0,
    'description' => 'Začítajte sa do šiesteho pokračovania najúspešnejšej fantasy ságy súčasnosti Trón zo skla, ktorého dej sa odohráva zároveň s piatym dielom Búrka v impériu. Znovu objavte čaro príbehov Sarah J. Maas, tak ako si ho pamätáte zo začiatku série.

Kapitán kráľovskej gardy Chaol Westfall bol známy svojou chrabrosťou, silou a bezpodmienečnou oddanosťou korune. No všetko sa zmenilo po zničení skleneného zámku a vyvraždení jeho mužov, hoci adarlanský kráľ ušetril jeho život. Duša sa síce časom zahojí, no jeho telo je nenapraviteľne poškodené. Uzdravenie mu ponúkajú len legendy o tajomstvami opradených liečiteľoch v ďalekej krajine na Južnom kontinente. Nad Erileou sa však znášajú búrkové mraky, Aelin a Dorian sa nedokážu vyhnúť ničivej vojne a ich jedinú šancu na víťazstvo držia v rukách Chaol a Nesryn a ich schopnosť presvedčiť mocných pánov juhu, aby sa pridali k vojne na severe. Južný kontinent však skrýva mnohé tajomstvá, ktoré môžu mať nečakané následky pre celý svet.

Komu sa kniha môže páčiť: Milovníkom nadupaného fantasy sveta Sarah J. Maas.',
    'image' => 'https://mrtns.sk/tovar/_l/262/l262590.jpg?v=17777033782',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  19 => [
    'title' => 'Na dvore z tŕňov a ruží',
    'author' => 'Sarah J. Maas',
    'price' => 12.0,
    'discount' => 0,
    'description' => 'Keď devätnásťročná lovkyňa Feyre zabije v lese vlka, na prah jej domu dorazí nebezpečný netvor, ktorý sa dožaduje odplaty. Feyre sa razom ocitá uprostred zákernej čarovnej krajiny, ktorú pozná len z rozprávok a legiend. Až tam zistí, že jej uchvatiteľ nie je žiadny netvor, ale príslušník rasy smrteľne nebezpečných a nesmrteľných férov, kedysi vládnucich celému svetu. A volá sa Tamlin. Na jeho panstve si postupne uvedomuje, že ľadová nevraživosť, čo k nemu pociťovala, sa premieňa na spaľujúcu vášeň pohlcujúcu všetky klamstvá a výstrahy o prekrásnom, no nebezpečnom svete férov. Férsku krajinu však zahaľuje prastarý zlovestný tieň. Feyre musí objaviť spôsob, ako ho zastaviť... inak má na svedomí Tamlina aj celú férsku rasu.',
    'image' => 'https://mrtns.sk/tovar/_xl/2574/xl2574737.jpg?v=17777267412',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  20 => [
    'title' => 'Krutý princ',
    'author' => 'Holly Black',
    'price' => 22.0,
    'discount' => 0,
    'description' => 'Vítejte ve světě, kterému vládnou nelítostné víly! První díl napínavé fantasy série
Jude bylo sedm, když jí zabili rodiče a unesli spolu se sestrami na proradný dvůr víl. O deset let později ale netouží Jude po ničem jiném než patřit mezi víly. A to i přes to, že je smrtelná. Většina víl lidmi pohrdá a nejvíce podlý princ Cardan. Aby Jude získala vysněné místo u dvora, musí princi vzdorovat. Zaplete se však do intrik, a když hrozí, že násilí zničí slavný dvůr, rozhodne se pro pochybné spojenectví, které ji může stát život.',
    'image' => 'https://mrtns.sk/tovar/_l/2602/l2602429.jpg?v=17777835392',
    'category' => 'Beletria',
    'status' => 'inactive',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => true,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  21 => [
    'title' => 'Na dvore z hmly a besu',
    'author' => 'Sarah J. Maas',
    'price' => 14.2,
    'discount' => 0,
    'description' => 'Druhý diel fantasy série Na dvore z tŕňov a ruží od autorky bestselleru Trón zo skla je ešte temnejší a fantastickejší než prvý. Po tom, čo Feyre zachránila krajinu Prythian, si čitatelia mysleli, že zazvonil zvonec a rozprávky je koniec. Feyre sa ocitla v bezpečí, obklopená bohatstvom a luxusom, pripravená na sobáš s milovaným Tamlinom, aby žili šťastne až do smrti. Feyre na rozdiel od svojich sestier nikdy netúžila po osude princeznej z rozprávok. V nočných morách sa vracia k boju s Amaranthou, pri ktorom položila svoj ľudský život, a tým zlomila kliatbu, získala nesmrteľnosť a schopnosti férov. Doteraz nedokáže zabudnúť na hrôzy, čo zažila pri oslobodení Tamlina, ani na zmluvu s Rhysom, lordom Nočného dvora. Prečo sa jej nedarí nadchnúť pre obnovu Jarného dvora? Prečo sa cíti naplnená, iba keď je s Rhysom? Na to nedokáže prísť ani sama. Feyre musí rýchlo spoznať svoje nové nesmrteľné telo a schopnosti, o ktorých dlho ani netušila. Na obzore sa totiž prebúdza prastarý nepriateľ, oveľa nebezpečnejší ako Amarantha, a má na muške svet ľudí aj férov.',
    'image' => 'https://mrtns.sk/tovar/_l/2574/l2574739.jpg?v=17778690312',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  22 => [
    'title' => 'Na dvore z krídel a zmaru',
    'author' => 'Sarah J. Maas',
    'price' => 15.29,
    'discount' => 0,
    'description' => 'V napínavom treťom dieli série Na dvore z tŕňov a ruží svetového bestselleru od Sarah J. Maas blížiaca sa vojna ohrozí všetko, čo je Feyre drahé. Feyre sa vracia na Jarný dvor, odhodlaná získať informácie od Tamlina a útočiaceho kráľa, ktorí chcú zraziť Prythian na kolená. Aby sa jej to podarilo, musí hrať smrteľne nebezpečnú hru plnú úskokov - jediné pošmyknutie môže znamenať porážku nielen pre ňu, ale aj pre celý jej svet. Bude sa musieť rozhodnúť, komu spomedzi oslňujúcich a nebezpečných Najvyšších lordov veriť, a hľadať spojencov na najneočakávanejších miestach. A tak zatiaľ čo na bojovom poli zúri vojna, najväčší boj sa odohrá vo Feyrinom srdci. V epickom finále napínavého príbehu sa zem sfarbí krvou a mocné armády sa stretnú v boji o nadvládu toho jediného, čo ich môže všetkých zabiť.',
    'image' => 'https://mrtns.sk/tovar/_l/2574/l2574741.jpg?v=17778690312',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  23 => [
    'title' => 'Na dvore z hviezd a mrazu',
    'author' => 'Sarah J. Maas',
    'price' => 12.6,
    'discount' => 0,
    'description' => 'Novela k jednej z najúspešnejších fantasy ság Na dvore z tŕňov a ruží!
Feyre, Rhys a ich priatelia sú zaneprázdnení odstraňovaním škôd, ktoré počas pohnutých časov vojny utrpel Nočný dvor a aj značne zmenený zvyšok sveta. No Zimný slnovrat je konečne tu a s ním aj zaslúžený oddych. Ani slávnostná atmosféra však nedokáže celkom zahnať temné tiene minulosti a Feyre zisťuje, že tí, na ktorých jej najviac záleží, sú poznačení hlbšie, než si pôvodne myslela, a že rany, čo utŕžili, môžu mať nedozerný vplyv na budúcnosť celého dvora. Povinné čítanie pre všetkých fanúšikov bestsellerovej série o ďalších osudoch hrdinov, ktorých si zamilovali čitatelia po celom svete.',
    'image' => 'https://mrtns.sk/tovar/_l/2574/l2574743.jpg?v=17779161732',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  24 => [
    'title' => 'Na dvore zo strieborných plameňov',
    'author' => 'Sarah J. Maas',
    'price' => 15.5,
    'discount' => 0,
    'description' => 'Pokračovanie celosvetového hitu Na dvore z tŕňov a ruží!

Hrdá Nesta Archeronová sa vždy ľahko nahnevala a ťažko odpúšťala. Po tom, čo ju násilím ponorili do Kotla a proti jej vôli premenili na férku, si len s námahou hľadá svoje miesto v tom cudzom, pre ňu novom svete, plnom nebezpečenstiev. A čo je horšie, stále nedokáže zabudnúť na útrapy vojny s Hybernom a vyrovnať sa so stratami. Viac než ktokoľvek iný ju dokáže rozzúriť Cassian, skúsený bojovník, ktorého pozícia na Nočnom dvore ho stále drží v Nestinej blízkosti. Hnev však nie je to jediné, čo v jeho spoločnosti cíti. Iskrenie medzi nimi je nepopierateľné a plamene sa naplno rozhoria, keď ich okolnosti donútia tráviť spolu čoraz viac času. Na kontinente zatiaľ zradné kráľovné ľudí uzavreli nové, nebezpečné spojenectvo, ktorým ohrozili krehký mier vo všetkých ríšach. Aby ich Nesta a Cassian dokázali zastaviť, budú musieť čeliť hrôzam zo svojej minulosti. A tak vo svete, ktorý sa ešte nespamätal z vojny a už ním znovu zmieta neistota, obaja zvádzajú boj so svojimi vnútornými démonmi aj s nepriateľmi zvonku a súčasne hľadajú prijatie - a záchranu - v náručí toho druhého.',
    'image' => 'https://mrtns.sk/tovar/_l/977/l977413.jpg?v=17779161732',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  25 => [
    'title' => 'The Wicked King',
    'author' => 'Holly Black',
    'price' => 13.0,
    'discount' => 0,
    'description' => 'Jude has tricked Cardan onto the throne, binding him to her for a year and a day. But the new High King does everything in his power to humiliate and undermine her, even as his fascination with her remains undimmed. Meanwhile, a traitor in the court is scheming against her. Jude must fight for her life and the lives of those she loves, all while battling her own complicated feelings for Cardan. Now a year and a day seems like no time at all.',
    'image' => 'https://mrtns.sk/tovar/_xl/592/xl592891.jpg?v=17782151612',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  26 => [
    'title' => 'The Queen of Nothing',
    'author' => 'Holly Black',
    'price' => 13.95,
    'discount' => 0,
    'description' => 'The intoxicating and bloodthirsty finale to the New York Times bestselling The Cruel Prince, nominated for the CILIP CARNEGIE MEDAL 2019, and New York Times bestseller The Wicked King, winner of the Best YA Fantasy category in the Goodreads Choice Awards

After being pronounced Queen of Faerie and then abruptly exiled by the Wicked King Cardan, Jude finds herself unmoored, the queen of nothing. She spends her time with Vivi and Oak, watching reality television, and doing odd jobs, including squaring up to a cannibalistic faerie. When her twin sister Taryn shows up asking a favour, Jude jumps at the chance to return to the Faerie world, even if it means facing Cardan, who she loves despite his betrayal. When a dark curse is unveiled, Jude must become the first mortal Queen of Faerie and break the curse, or risk upsetting the balance of the whole Faerie world.',
    'image' => 'https://mrtns.sk/tovar/_xl/771/xl771925.jpg?v=17782151592',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  27 => [
    'title' => 'Once Upon a Broken Heart',
    'author' => 'Stephanie Garber',
    'price' => 13.9,
    'discount' => 0,
    'description' => 'For as long as she can remember, Evangeline Fox has believed in true love and happy endings . . . until she learns that the love of her life will marry another.

Desperate to stop the wedding and to heal her wounded heart, Evangeline strikes a deal with the charismatic, but wicked, Prince of Hearts. In exchange for his help, he asks for three kisses, to be given at the time and place of his choosing.

But after Evangeline’s first promised kiss, she learns that bargaining with an immortal is a dangerous game ― and that the Prince of Hearts wants far more from her than she’d pledged. He has plans for Evangeline, plans that will either end in the greatest happily ever after, or the most exquisite tragedy.',
    'image' => 'https://mrtns.sk/tovar/_l/3268/l3268319.jpg?v=17782959062',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  28 => [
    'title' => 'Ballad of Never After',
    'author' => 'Stephanie Garber',
    'price' => 14.2,
    'discount' => 0,
    'description' => 'The Ballad of Never After by Stephanie Garber is the jaw-dropping sequel to the globally bestselling Once Upon a Broken Heart starring Evangeline Fox and the Prince of Hearts on a journey of magic, mystery, and heartbreak. NOT EVERY LOVE IS MEANT TO BE . . .After Jacks, the Prince of Hearts, betrays her, Evangeline Fox swears she\'\'ll never trust him again. Now that she\'\'s discovered her own magic, Evangeline believes she can use it to restore the chance at happily ever after that Jacks stole away.But when a new terrifying curse is revealed, Evangeline finds herself entering into a tenuous partnership with the Prince of Hearts again. Except this time, the rules have changed. Jacks isn\'\'t the only force she needs to be wary of. In fact, he might be the only one she can trust, despite her desire to despise him.Instead of a love spell wreaking havoc on Evangeline\'\'s life, a murderous spell has been cast. To break it, Evangeline and Jacks will have to do battle with old friends, new foes, and a magic that plays with heads and hearts. Evangeline has always trusted her heart, but this time she\'\'s not so sure . . .',
    'image' => 'https://mrtns.sk/tovar/_l/3277/l3277817.jpg?v=17782151392',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
  29 => [
    'title' => 'A Curse For True Love',
    'author' => 'Stephanie Garber',
    'price' => 24.95,
    'discount' => 0,
    'description' => 'Two villains, one girl, and a deadly battle for happily ever after. Evangeline Fox ventured to the Magnificent North in search of her happy ending, and it seems as if she has it. She\'\'s married to a handsome prince and lives in a legendary castle. But Evangeline has no idea of the devastating price she\'\'s paid for this fairytale. She doesn\'\'t know what she has lost, and her husband is determined to make sure she never finds out . . . but first he must kill Jacks, the Prince of Hearts. Blood will be shed, hearts will be stolen, and true love will be put to the test in A Curse for True Love, the breathlessly anticipated conclusion to the Once Upon A Broken Heart trilogy.',
    'image' => 'https://mrtns.sk/tovar/_xl/2790/xl2790023.jpg?v=17783165252',
    'category' => 'Beletria',
    'status' => 'active',
    'is_new' => false,
    'is_preorder' => false,
    'is_bestseller' => false,
    'published_at' => NULL,
    'preorder_date' => NULL,
    'genres' => [
      0 => 'beletria',
      1 => 'fantasy',
      2 => 'romantika',
    ],
  ],
];

        foreach ($books as $bookData) {
            $genreSlugs = $bookData['genres'] ?? [];
            unset($bookData['genres']);

            $book = Book::create($bookData);

            $genreIds = Genre::whereIn('slug', $genreSlugs)->pluck('id');
            $book->genres()->sync($genreIds);
        }
    }
}