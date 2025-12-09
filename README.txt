📦 Inventory Management System – Përshkrimi i Projektit

Ky projekt është një sistem menaxhimi të inventarit, i ndërtuar për shkolla ose kompani të vogla. Përfshin panel të veçantë për admin dhe user, me funksione të kontrolluara sipas rolit.

Sistemi është i ndërtuar me teknologji bazike dhe të lehta për përdorim:

PHP

MySQL

HTML, CSS, JavaScript

Chart.js

XAMPP (Apache + MySQL)

🚀 Karakteristikat Kryesore
1. Login System (Admin & User)

Sistemi ka një faqe hyrëse ku përdoruesi fut username dhe password.
Në varësi të rolit, sistemi e dërgon përdoruesin në panelin përkatës:

Admin Panel

User Panel

2. Admin Panel

Admini ka qasje të plotë në sistem dhe mund të menaxhojë të gjitha të dhënat.
Funksionalitetet përfshijnë:

Dashboard me statistika

Menaxhimin e produkteve (shtim, editim, fshirje)

Menaxhimin e furnizuesve

Menaxhimin e përdoruesve

Menaxhimin e shitjeve

Ndryshimin e cilësimeve të sistemit (si p.sh. dark mode)

Daljen nga sistemi

3. User Panel

Përdoruesi i thjeshtë ka një panel më të kufizuar.
Mund të:

Shikojë dashboard-in e tij

Shikojë listën e produkteve

Shikojë furnizuesit

Shkyçet nga sistemi

Nuk ka të drejta për të modifikuar të dhëna.

4. Sidebar Automatik

Navigimi anësor (sidebar) ndryshon automatikisht bazuar në rolin e përdoruesit.
Admini sheh opsionet e tij, ndërsa user-i sheh një version më të thjeshtë.

🌙 Light & Dark Mode

Përdoruesi mund të zgjedhë mes:

Dark Mode

Light Mode

Zgjedhja ruhet automatikisht dhe ngarkohet çdo herë që hapet faqja.

📊 Dashboard (Admin)

Përfshin:

Numrin total të produkteve

Produktet me stok të ulët

Vlerën totale të stokut

Statuse si OK, Defekt, Në Servis

Pajisjet e fundit të shtuar

Grafikun me produktet kryesore sipas stokut

📁 Struktura e Projektit

Projekti është i organizuar në disa dosje:

assets (CSS, JavaScript, imazhe)

partials (header, footer, sidebar)

faqet kryesore (dashboard, products, suppliers, sales, users, settings)

sistemi i login-it

database (skedari SQL)

🔧 Instalimi

Instaloni XAMPP.

Vendosni projektin në folderin htdocs.

Importoni databazën me phpMyAdmin.

Ndryshoni të dhënat e lidhjes në db.php nëse duhet.

Hapeni projektin në browser duke shkruar:
http://localhost/inv/

🔐 Fjalëkalimet Parazgjedhje

Admin:

Username: admin

Password: admin

User:

Username: user

Password: user

🧪 Funksionimi i Role-Based Access

Sistemi kontrollon rolin e përdoruesit dhe kufizon qasjen në faqet që nuk i takojnë atij roli.

🔥 Çfarë mund të shtohet në të ardhmen

Sistem për backup dhe restore të databazës

Eksporim të të dhënave në Excel/PDF

Notifikime për stok të ulët

Statistikë shtesë

Log i aktiviteteve të përdoruesve

📄 Licenca

Ky projekt është i thjeshtë për përdorim edukativ dhe mund të modifikohet sipas nevojës.
