-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 13, 2019 alle 17:57
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecweb`
--
CREATE DATABASE IF NOT EXISTS `tecweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tecweb`;

-- --------------------------------------------------------

--
-- Struttura della tabella `articoli`
--

DROP TABLE IF EXISTS `articoli`;
CREATE TABLE `articoli` (
  `id` int(11) NOT NULL,
  `testo` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `titolo` varchar(512) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `descrizione` varchar(1024) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `dataPubblicazione` date DEFAULT NULL,
  `dataScadenza` date DEFAULT NULL,
  `prezzo` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `immagine` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `articoli`
--

INSERT INTO `articoli` (`id`, `testo`, `titolo`, `descrizione`, `tipo`, `dataPubblicazione`, `dataScadenza`, `prezzo`, `immagine`) VALUES
(1, 'Lo smartphone Honor 10 ha fatto il suo primo debutto nei mercati indiani nell\'aprile 2018. Lo smartphone ha uno schermo da 5,84 pollici con risoluzione 1080 x 2280 pixel. Misura 149,6 x 71,2 x 7,7 mm e pesa 153 grammi.\r\nL\'altra variante di Honor 10 mobile Ã¨ Honor View 10. Honor 10 funziona con il sistema operativo Android 8.1 (Oreo). Ãˆ alimentato da processori Octa-core, con clock a velocitÃ  4 GHz e GPU Mali-G72 MP12. \r\nHonor 10 ha una capacitÃ  della batteria di 3400 mAh. \r\nPer le foto, lo smartphone dispone di una fotocamera posteriore da 16 MP con doppio flash LED e apertura f/1.8. Sul davanti, il portatile ha un sensore da 24 megapixel.\r\nHonor 10 viene fornito con 6 GB di RAM e 64 GB di memoria interna. Le opzioni di connettivitÃ  nello smartphone includono Hostpot, Bluetooth, Wi-Fi, GPS e reti 2G, 3G e 4G.', 'Honor 10 in offerta', 'Compra da noi il nuovo Honor 10', '0', '2019-01-01', '2019-02-28', '275 &euro;', 'uploads/honor10.jpg'),
(2, 'La nuova connettivit&agrave; del 5G &egrave; entrata ufficialmente nella fase di sviluppo. Tante le aziende che stanno cercando di capire come muoversi nella creazione di una propria rete e soprattutto come riuscire a sfruttare al meglio questa nuova potenzialit&agrave; del 5G. Abbiamo visto che tanti sono i possibili scenari ma di certo quello che potrebbe di pi&ugrave; attirare gli utenti &egrave; l\'uso della nuova connettivit&agrave; con gli smartphone del futuro.\r\n\r\nHuawei sin dall\'inizio &egrave; stata tra le prime aziende ad interessarsi ma soprattutto a sviluppare nuovi progetti incentrati proprio sulla connettivit&agrave; 5G. Di fatto, secondo un report di DigiTimes, i primi esemplari di smartphone progettati dall\'azienda cinese capaci di connettersi al 5G hanno ottenuto risultati decisamente negativi per quanto concerne l\'autonomia e il surriscaldamento.\r\n\r\nSecondo quanto dichiarato dal CEO di Huawei, Eric Xu, nelle prime prove in laboratorio si &egrave; potuto constatare come il nuovo chip 5G consumer&agrave; addirittura 2.5 volte in pi&ugrave; rispetto a quanto avviene oggi con un classico chip 4G. &Egrave; palese che la tecnologia alla base della connettivit&agrave; 5G &egrave; completamente diversa da quella attuale ed &egrave; chiaro anche che le performance risultano fortemente pi&ugrave; elevate rispetto alle odierne. Questo dunque non pu&ograve; non comportare un aumento importante dei consumi e delle richieste di consumo che superano di gran lunga quelle degli smartphone odierni.\r\n\r\nLa conseguenza sullo sviluppo dei prossimi device potrebbe chiaramente riguardare il design oltre ad un cambiamento importante delle componenti. Da una parte sar&agrave; inevitabile dover utilizzare delle batterie decisamente pi&ugrave; importanti di quelle attuali. Ma non solo perch&eacute; il surriscaldamento necessiter&agrave;  anche di componenti di dissipazione pi&ugrave; performanti. Ecco che proprio Huawei ha gi&agrave; fatto realizzare un heatpipe ossia un modulo di dissipazione in rame adatto appunto ad uno smartphone per il 5G. Le differenze con quelli attuali? Lo spessore.', 'Supporto del 5G sugli smartphone Honor', 'Huawei a lavoro sul 5G per i suoi smartphone', '1', '2019-01-01', '2019-02-28', '0', 'uploads/Honor-5G.jpg'),
(3, 'Se hai problemi con il tuo pc, non scomodarti! Veniamo noi da te a ripararlo!\r\nPagando una piccola cifra al mese avrai a tua disposizione 4 tecnici disponibili per riparazioni a domicilio 24/7.\r\nGestiamo le garanzie di tutti i nostri prodotti e anche, con un piccolo esborso, dei prodotti acquistati in altre strutture che non vi seguono convenientemente. \r\nInoltre forniamo i miglior prezzi per le sostituzioni di parti rotte.\r\nCosa aspetti?! comincia subito la prova di un mese gratuita e paga successivamente per i mesi successivi.', 'Riparazioni Hardware a domicilio', 'Hai un problema con il tuo PC? Veniamo noi a ripararlo!', '1', '2019-01-01', '2019-02-28', '25 &euro;/mese', 'uploads/riparazione-PC.jpg'),
(4, 'Compra da noi la nuova PS4 pro in offerta!\r\nLa console PlayStation4 Pro &egrave; in grado di offrire un&apos;esperienza di gioco pi&ugrave; avanzata grazie alla maggiore capacit&agrave; di elaborazione dell&apos;immagine e al supporto della risoluzione 4K (in rendering o upscaling delle immagini).\r\n\r\nAumentando le prestazioni e la potenza della CPU, della GPU e in generale dell&apos;intera architettura di sistema, PS4 Pro rende possibili giochi contraddistinti da una grafica di gran lunga pi&ugrave; dettagliata e da una perfezione visiva senza precedenti. I possessori di TV 4K potranno giocare tutti i titoli PS4 ad un livello qualitativamente superiore grazie alla risoluzione 4K e a frequenze di aggiornamento pi&ugrave; rapide o pi&ugrave; stabili. PS4 Pro consente inoltre la riproduzione di contenuti video 4K, dando in tal modo la possibilit&agrave; di fruire di servizi di streaming video 4K come Netflix e YouTube.\r\n\r\nAnche i possessori di TV HD godranno di una migliore qualit&agrave; di gioco su PS4 Pro, perch&eacute; il sistema garantisce la risoluzione 1080p per tutti i giochi PS4 e frequenze di aggiornamenti maggiori o pi&ugrave; stabili per i titoli supportati.\r\n\r\nCon lo sguardo rivolto al futuro della tecnologia dell&apos;immagine, inoltre, tutti i sistemi PS4, compreso PlayStation 4 Pro, supportano (tramite aggiornamento del software di sistema) la tecnologia HDR (High Dynamic Range), che consente una migliore riproduzione di luci e ombre e offre una gamma molto pi&ugrave; ampia di colori. I possessori di una TV compatibile con lo stardad HDR potranno godersi giochi e altri contenuti supportati dalle immagini pi&ugrave; realistiche, straordinariamente vivide e pi&ugrave; fedeli al modo in cui effettivamente l&apos;occhio umano vede il mondo.', 'PS4 pro in offerta', 'Compra da noi la nuova console PS4 PRO', '0', '2019-01-01', '2019-02-28', '399 &euro;', 'uploads/ps4-pro.jpg'),
(5, 'Due tecnici fissi nel nostro laboratorio sono a Vostra completa disposizione per ascoltare e risolvere i Vostri problemi sia hardware che software. Gestiamo le garanzie di tutti i nostri prodotti e anche, con un piccolo esborso, dei prodotti acquistati in altre strutture che non vi seguono convenientemente.  \r\n\r\nUn servizio completo, dalla qualificazione del guasto, la stesura del preventivo e la riparazione.\r\n\r\nUn sistema di tracciabilit&agrave; minuzioso raccoglie i dati di tutta la nostra clientela, delle loro macchine, dei lavori eseguiti e dei risultati ottenuti.', 'La nostra assistenza telematica sempre attiva', 'Uno dei nostri fiori all\'occhiello, la nostra assistenza telematica', '1', '2019-01-01', '2019-02-28', '25 &euro;/mese', 'uploads/customer-services.jpg'),
(6, 'Pi&ugrave; elegante, pi&ugrave; sottile, pi&ugrave; nitida. La nuova console Xbox One X, realizzata in un elegante design nero, &egrave; dotata della straordinaria tecnologia 4K Ultra HD che permette di riprodurre video 4K in streaming su Netflix e di guardare film in Blu-ray UHD. Inoltre, grazie alla tecnica HDR (High Dynamic Range) i colori nei giochi e nei video sono pi&ugrave; brillanti e luminosi, il contrasto tra chiari e scuri &egrave; maggiore e la profondit&agrave; visiva &egrave; assolutamente realistica.\r\n\r\nXbox One X &egrave; anche pi&ugrave; piccola del 40%, ma non farti ingannare dalle dimensioni: con un alimentatore integrato e fino a 1 TB di spazio di archiviazione, Xbox One X &egrave; la console Xbox pi&ugrave; avanzata di sempre.', 'XBOX One X in offerta', 'Compra da noi la nuova console XBOX One X', '0', '2019-01-01', '2019-02-28', '449 &euro;', 'uploads/XBOX-ONEX.jpg'),
(7, 'Arriva come novit&agrave; del 2019, annunciata al CES di Las Vegas, la nuova proposta NVIDIA per il segmento di fascia media del mercato. Basata su architettura Turing e dotata di supporto al Ray Tracing, la nuova scheda spicca per il netto balzo in avanti delle prestazioni che permette di ottenere rispetto al modello GeForce GTX 1060 che va a sostituire sul mercato.\r\nIl Ray Tracing non &egrave; ancora per tutti, &egrave; bene ricordarlo: i requisiti di sistema, in termini di potenza di elaborazione della componente video, sono ancora troppo elevati e ci vorr&agrave; del tempo affinch&eacute; il parco sistemi compatibile con questa tecnica sia sufficientemente ampio. Proprio per questo motivo dobbiamo parlare di rendering ibrido, intendendo con questo l\'utilizzo del Ray Tracing in abbinamento alle tecniche di rasterizzazione tradizionali, e sempre per la stessa ragione ha senso una scheda come GeForce RTX 2060 che viene posizionata nel segmento mainstream del mercato e rende accessibile il Ray Tracing ad un numero pi&ugrave; ampio di utenti appassionati. Ci vorr&agrave; tempo, ma nelle intenzioni di NVIDIA sar&agrave; questa l\'evoluzione futura nel settore dei videogiochi.', 'Annunciata NVIDIA GeForce RTX 2060', 'NVIDIA GeForce RTX 2060: la scheda Turing che tutti attendono', '1', '2019-01-01', '2019-02-28', '0', 'uploads/N2060.jpg'),
(8, 'Surface Pro 6 &egrave; stato uno dei protagonisti dell\'evento hardware tenuto da Microsoft nelle scorse ore. Il nuovo esponente della linea di 2-in-1 di Microsoft arriva sul mercato con un design sostanzialmente invariato rispetto al precedente Surface Pro, fatta eccezione per la finitura black, che si affianca a quella platinum e che viene ripresa dall\'azienda dopo averla abbandonata a partire dal Surface Pro 2. Il look pu&ograve; comunque essere modificato abbinando una TypeCover di colore differente.\r\n\r\nLe novit&agrave; maggiormente degne di nota si trovano all\'interno della scocca e coincidono con i nuovi processori Intel Core di ottava generazione (i5 o i7), che operano al meglio grazie ad un sistema di raffreddamento ulteriormente ottimizzato, grazie al quale &egrave; possibile impiegare processori quad-core. Per quanto riguarda le prestazioni, Microsoft afferma che il nuovo Surface Pro 6 &egrave; sino al 67% pi&ugrave; veloce rispetto al precedente modello.\r\n\r\nL\'autonomia dichiarata &egrave; pari a 13,5 ore, mentre non si registrano differenze per quanto riguarda il display che continua ad integrare un pannello da 12,3&quot; Pixel Sense con risoluzione 2736 x 1824 pixel; anche il peso complessivo &egrave; sostanzialmente invariato rispetto al Surface Pro (775 grammi per la versione i5 e 792 grammi per quella con i7).', 'Surface pro 6', 'Compra da noi il nuovo Surface pro 6', '0', '2019-01-01', '2019-02-28', '999 &euro;', 'uploads/surface6.jpg'),
(9, 'La console da casa portatile!\r\nNintendo Switch &egrave; una console casalinga rivoluzionaria che non solo si connette al televisore di casa, ma si trasforma anche in un sistema da gioco portatile grazie al suo schermo da 6,2 pollici con touch screen multi-touch capacitivo. Fino a otto console possono essere collegate tramite connessione locale, per giocare in multiplayer dove, quando e con chi si vuole. La console permette inoltre di giocare in multiplayer online e anche in modalit&agrave; da tavolo condividendo un Joy-Con a testa. I giocatori possono godersi un&rsquo;esperienza da console casalinga completa in qualsiasi momento e dovunque si trovino.', 'Nintendo Switch in offerta', 'Compra da noi il nuovo Nintendo Switch', '0', '2019-01-01', '2019-02-28', '299 &euro;', 'uploads/Nintendo-Switch.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `cognome` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `telefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`idUtente`, `nome`, `cognome`, `telefono`, `password`, `email`) VALUES
(1, 'admin', 'admin', '1234567890', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com'),
(2, 'utente', 'utente', '0987654321', '6b4422410da6b1e7ccdea9788b5164a8b2ac8fc0', 'utente@utente.com');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
