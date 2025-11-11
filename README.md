# Projecte: GameZone

# 1.CONTEXT I SITUACIÓ INICIAL

# 

# &nbsp;L’espai on es vol desenvolupar el projecte és un antic restaurant que va tancar per manca de rendibilitat. Actualment, la propietària disposa d’una sala gran buida i vol donar-li un nou ús transformant-la en un Gaming Center, un espai on els usuaris puguin jugar a videojocs en xarxa o individualment amb equips d’alt rendiment.

# 

# &nbsp;El problema o necessitat que es vol cobrir és la manca d’espais locals per a l’oci digital i el joc en xarxa, especialment per a joves i aficionats als eSports. Aquest projecte afecta tant als possibles clients (jugadors) com als gestors del negoci, que necessiten una solució tecnològica completa, segura i fàcil de mantenir.

# 

# 

# 

# 2.ABAST I OBJECTIUS

# 

# 

# Objectiu general:

# 

# Dissenyar i implementar la infraestructura tecnològica i digital necessària per a posar en funcionament un Gaming Center funcional, segur i gestionable.

# Objectius específics:

# Crear una xarxa local robusta amb accés a Internet d’alta velocitat.

# 

# 

# Desenvolupar un sistema de gestió d’usuaris i temps d’ús dels ordinadors.

# 

# 

# Dissenyar una pàgina web per a reserves, informació i inici de sessió dels clients.

# 

# 

# Utilitzar serveis al núvol per a allotjament i gestió remota de dades.

# 

# 

# Implementar mesures bàsiques de ciberseguretat.

# 

# 

# Limitacions:

# El projecte no inclou el disseny interior complet (decoració o reforma física).

# 

# 

# Tampoc s’inclou la compra de llicències de jocs comercials ni la seva gestió legal.

# 

# 

# 3.SOLUCIONS TÈCNIQUES

# 

# 

# Pàgina web: HTML, CSS, JavaScript, PHP → Permet crear una web dinàmica amb gestió d’usuaris i connexió a la base de dades.

# &nbsp;Base de dades: MySQL / MariaDB → Emmagatzematge de comptes d’usuaris, temps d’ús i configuracions.

# &nbsp;Servidor: Hosting al núvol (AWS, Google Cloud o Azure) → Permet accés remot, escalabilitat i manteniment senzill.

# &nbsp;Gestió de sessions: Aplicació de control desenvolupada en Python o C# → Controla el temps d’ús dels ordinadors i bloqueja l’equip automàticament quan s’esgota.

# &nbsp;Xarxa local: Switch gigabit, router amb tallafoc integrat → Necessari per garantir velocitat i seguretat en el tràfic intern.

# &nbsp;Ciberseguretat: Antivirus centralitzat, tallafoc, permisos restringits → Protegeix la infraestructura de virus i accessos no autoritzats.

# &nbsp;Control de DNS i dominis: Servei de DNS vinculat al hosting → Per accedir a la web mitjançant un domini personalitzat (ex: gamingmonica.cat).

# Per a mostrar el temps, es podria fer un altre display, en el cual donant-li a un PLUS i pagant un temps extra, puguis seguir jugant.

# 

# 4.INTEGRACIÓ I INTERACCIÓ

# &nbsp;	

# Tots els components treballen de forma coordinada:

# 

# 

# Els clients accedeixen a la web allotjada al núvol, on poden crear un compte i reservar temps de joc.

# 

# 

# La web connecta amb la base de dades MySQL per validar usuaris i registrar sessions.

# 

# 

# Un programa local instal·lat als ordinadors del centre permet iniciar sessió i controla el temps d’ús segons les dades del servidor.

# 

# 

# La xarxa local assegura connexió estable entre els equips i el servidor intern.

# 

# 

# Les còpies de seguretat i el control d’accessos es gestionen des del núvol.

# 

# 

# 

# 5.PLANIFICACIÓ DEL PROJECTE

# 

# 

# Fase 1: Anàlisi i disseny (setmana 1-2) → Estudi de necessitats, diagrames de xarxa, disseny de BD i mockups web. Creació del repositori a GitHub.

# Fase 2: Desenvolupament (setmana 3-6) → Programació del backend (PHP, MySQL) i del programa de control d’usuaris.

# Fase 3: Integració (setmana 7) → Connexió entre la web, BD i aplicació local.

# Fase 4: Proves i validació (setmana 8) → Test de seguretat, rendiment i ús real.

# Fase 5: Documentació i presentació (setmana 9) → Elaboració de la memòria i vídeo demo.

# 

# 6.EXEMPLE DE WEB I PROGRAMA (DEMO BREU)

# 

# 

# Web: Interfície senzilla amb apartats “Inici”, “Reserva”, “Inicia sessió” i “Contacte”.

# 

# 

# Programa de PC: Pantalla inicial on l’usuari introdueix el seu nom i contrasenya; apareix una llista de jocs instal·lats; un cronòmetre indica el temps restant. Quan el temps acaba, l’ordinador es bloqueja automàticament.

# 

# 

# 

# 7.RESULTATS I VALIDACIÓ

# 

# 

# S’ha aconseguit una infraestructura funcional que cobreix totes les necessitats inicials.

# 

# 

# El sistema permet gestionar usuaris, sessions i seguretat de manera centralitzada.

# 

# 

# Objectius complerts: connectivitat, gestió de comptes i integració amb el núvol.

# 

# 

# Possibles millores: afegir un sistema de pagaments en línia, integració amb Steam o Epic Games, i una aplicació mòbil per a reserves.

# 

# 

# 8.CONCLUSIONS I APRENENTATGES

# 

# L’equip ha après a integrar diferents tecnologies (web, BD, xarxa i cloud) en un únic projecte real.

# S’han superat dificultats tècniques com la configuració de servidors remots, la connexió segura entre serveis i la gestió d’usuaris en entorns compartits.

# El projecte ha servit per entendre la importància de la planificació, la seguretat i la integració en entorns informàtics professionals.

# 



