# Feladat

Készítsünk egy egyszerű blogmotort, amelyben tudunk blogposztokat listázni, meg tudjuk nézni az egyes blogposztokat, a blogposztok kategorizáltak (címkékkel), vannak commentek (ha marad rá idő). Bejelentkezés után tudjon egy user posztot írni, tudja mindenki szerkeszteni és törölni a saját poszjait. Legyen egy admin jogosultság, amellyel egy user mindent szerkeszthet és törölhet, illetve szerkesztheti a kategóriákat is. A blogposztokhoz lehessen képeket csatolni - nem kötelező. Szerkesztésnél a kép legyen törölhető a blogposzt mellől. A kategóriákhoz tartozzanak színek. A blogposztok listája legyen lapozható. Legyen néhány "advanced" oldal is (ha marad idő): egy kategóriához tartozó összes poszt, egy szerzőhöz tartozó összes poszt. Ha lesz idő, csináljuk meg a felhasználói CRUD műveleteket.

## Milyen modellek kellenek ehhez?

Post - blogposzthoz tartozó modell - title, desc, text, author
Category - kategória - name, color (background, text)
// Pivot tábla
Comment - blogposzre érkezett komment - title, text, author
User - beépített + isadmin
