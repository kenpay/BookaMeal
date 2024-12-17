Documentatie user management

In acest spring, am implementat functionalitatea de signup, login, verificare email, password reset, utilizand PHP, JavaScript 
si MySQL.

Fisierul signup.php contine functionalitatea de creare a unui utilizator nou. Acesta dispune de urmatoarele functionalitati:

- reCAPTCHA pentru verificarea autenticitatii unui utilizator;

- verificarea in baza de date daca adresa de email exista deja, pentru a evita spamul precum si violari ale principiului de unicitate pentru adresele de mail care exsta in baza de date;

- referirea catre fisierul verify.php care genereaza un cod unic de verificare ce este trimis pe adresa de email specificata, este setat in sesiune alaturi de ora la care expira; acest cod este folosibil o singura data si expira dupa o ora daca nu este folosit;

- parola introdusa este hashuita si stocata in Baza de date sub forma e hash MD5;

- verificarea daca adresa de email are un format valid;

- validarea tuturor campurilor pentru a evita atacuri de tip SQL injection sau wildcard injection;

- referinta catre pagina de login dupa ce un user a fost creeat.


Pagina de login creaza un query SQL cu datele intrate si le verifica validitatea in cadrul bazei de date, facand referinta la pagina home.php, care nu este implementata in acest moment, aici va fi meniul principal al aplicatiei.

Pagina de login dispune si de functia de resetare a parolei, care trimite un cod de verificare pe adresa de email in baza caruia poate fi updatata parola din baza de date. Parola este stocata in format hashuit.

Baza de date de tip MySQL are doar tabela de useri, in care sunt incluse toate tabelele necesare functionalitatilor descrise pana acum.
Numele de utilizator si adresele de email sunt unice, este logata data si ora la care este creeat un user. In viitor va fi stocat aici si ultimul cod de validare generat, alaturi de data si ora crearii lui, pentru a se putea verifica daca e expirat; la ora actuala codurile sunt stocate in sesiune ceea ce nu ofera multa siguranta.

Utilizatorii au un atribut de in baza de date care le ofera sau nu calitatea de Admin. Acest atribut este verificat cu o functie din fisierul functions.php, urmand ca in viitor sa aiba aptitudini suplimentare, precum editarea meniului disponibil clientilor.
