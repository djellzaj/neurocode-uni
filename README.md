# neurocode-uni
Faza I (PHP) – NeuroCode

## Përshkrimi

NeuroCode është një aplikacion web i thjeshtë që simulon menaxhimin e të dhënave dhe përdoruesve. Në Fazën I, projekti fokusohet në përdorimin e PHP pa databazë, duke përdorur të dhëna të simuluara (arrays).

## Funksionalitetet

- Login dhe Logout me të dhëna statike (hardcoded)
- Menaxhimi i sesioneve (sessions)
- Role të ndryshme të përdoruesve (p.sh. admin dhe user)
- Përdorimi i cookies për personalizim
- Validimi i inputeve me RegEx
- Përdorimi i arrays dhe strukturave të ndryshme të të dhënave
- Implementimi i OOP (klasa, trashëgimi, enkapsulim)

## Struktura e Projektit

- `/pages` – faqet kryesore të aplikacionit
- `/includes` – header, footer dhe navigimi
- `/classes` – klasat PHP
- `/assets` – CSS, imazhe dhe resurset tjera

## Teknologjitë e përdorura

- PHP
- HTML
- CSS


## Faza II (PHP + MySQL + AJAX)

Në Fazën II, projekti është zgjeruar duke integruar databazën MySQL dhe funksionalitete më të avancuara të PHP-së për menaxhimin real të të dhënave.

### Funksionalitetet e Shtuara

* Integrimi me databazë MySQL
* CRUD për menaxhimin e klientëve dhe projekteve
* Prepared Statements për mbrojtje nga SQL Injection
* Sanitizim i inputeve dhe outputeve kundër XSS
* Hashimi dhe verifikimi i fjalëkalimeve
* AJAX për operacione pa refresh të faqes
* Manipulim dhe upload i fajllave
* Error handling me try/catch
* Integrimi i Web API të jashtme
* Dërgimi i email-eve përmes formës së kontaktit

### Struktura e Re e Projektit

/config – konfigurimi i databazës
/database – SQL dump dhe struktura e databazës
/ajax – funksionalitete AJAX
/uploads – fajllat e ngarkuar nga përdoruesit

### Teknologjitë e Shtuara

* MySQL
* JavaScript
* AJAX

