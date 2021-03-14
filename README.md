# Photo gallery project
Projekt ten został przygotowany jako część kursu WWW i języki skryptowe na kierunku Teleingormatyka na AGH
# Dodawanie zdjęć
W celu wgrania zdjęcia należy przejść do zakładki “ADD PHOTO”. Znajduje się tam pole drag&drop na które możemy przeciągnąć zdjęcie, które chcemy dodać do galerii (Rys.1). Po upuszczeniu zdjęcia w wyznaczonym polu pojawi się miniaturka zdjęcia nad formularzem(Rys. 2). Możemy również wgrać zdjęcie przez naciśnięcie pola “Choose an image file or drag it here” i wybranie odpowiedniego pliku.
Następnie możemy dodać opis zdjęcia w polu “Description” oraz kategorie. Możemy utworzyć nową kategorię przez wpisanie jej w polu oznaczonym jako “Create own category …” lub wybrać jedną z kategorii, która już znajduje się na stronie za pomocą listy  umieszczonej pod etykietą “or choose one of this”.
 Jeśli wybierzemy jedną z opcji, np. zaczniemy coś wpisywać w polu do tworzenia nowej kategorii, to możliwość wyboru kategorii z listy zostanie zablokowana (Rys.2), podobnie jeśli wybierzemy coś z listy to pole tekstowe do wpisywania kategorii zostanie zablokowane (Rys.3). Wystarczy jednak wymazać to co wpisaliśmy lub odznaczyć wybraną opcję, aby z powrotem odblokować te pola. 
 Następnie naciskamy przycisk “Submit” w celu dodania zdjęcia do galerii.
Zostały utworzone pewne ograniczenia co do wgrywanych plików. 
- można wgrywać tylko pliki o rozszerzeniu .png, .jpg, .jpeg.
- rozmiar wgrywanych zdjęć nie może przekroczyć 20MB 
- każde zdjęcie może należeć do max 1 kategorii 

# Tworzenie i usuwanie kategorii
Zdjęcie można dodać do danej kategorii przy jego wgrywaniu na stronę, ale istnieje też możliwość zmiany kategorii do jakiej należy dane zdjęcie już po jego dodaniu. W tym celu należy nacisnąć przycisk edit, który znajduje się pod każdym ze zdjęć w galerii (Rys. 6). Przejdziemy dzięki temu do podstrony w której możemy dokonać edycji kategorii i opisu danego zdjęcia (Rys. 7).
W celu usunięcia danej kategorii należy nacisnąć ikonę kosza znajdującą się pod kategorią którą chcemy usunąć. Po usunięciu danej kategorii znika ona z opisu wszystkich zdjęć które do niej należały.


# Tworzenie miniaturek

Na stronie głównej (zakładka “GALLERY”) znajdują się miniaturki wgranych zdjęć.
Istnieje możliwość dynamicznej zmiany sposobu wyświetlania miniaturek na stronie. W zakładce “SETTINGS” możemy wybrać czy chcemy aby miniaturki były “ściśniętymi wersjami wgranych obrazów  -> opcja “squeeze” czy wyciętym centralnym fragmentem obrazka -> opcja “cut”. 
Dodatkowo możemy również ustalić wymiary miniaturek w pikselach uzupełniając pola width i height, a dokonany wybór zatwierdzając przyciskiem “Change”.
Istnieje ograniczenie co do rozmiaru miniaturek, jeśli użytkownik jako wysokość lub szerokość wybierze wartość mniejszą od 200, to wymiary miniaturek zostaną ustawione na 300 (w celu zachowania spójności layoutu).
Wybrane parametry (styl miniaturki oraz jej wymiary są zapamiętywane w local storage przeglądarki, więc nawet po odświeżeniu strony, czy wyłączeniu i ponownym włączeniu strony w dalszym ciągu nasz wybór będzie zapamiętany).

# Edycja podpisów
Naciskając przycisk edit, który znajduje się pod każdym zdjęciem mamy możliwość edycji opisu zdjęcia.

# Zabezpieczenie przed pobraniem
Na obszarze całej strony za pomocą JS została zablokowana możliwość naciskania prawego przycisku myszki oraz wszystkie kombinacje klawiszy umożliwiające wyświetlenie kodu źródłowego. Nie blokuje to oczywiście całkowicie możliwości pobrania zdjęcia, ale znacznie to utrudnia.

# Filtrowanie
Istnieje możliwość filtrowania wyświetlanych zdjęć na podstawie kategorii, w tym celu należy nacisnąć przycisk z nazwą danej kategorii i na ekranie pojawią się tylko określone zdjęcia.

# Technologie wykorzystane przy tworzeniu projektu:
- PHP
- JavaScript
- jQuery
- HTML
- CSS
- Bootstrap
- TinyMCE (edytor tekstu)
