- The task is to implement the business domain logic associated with the evaluation
process based on the description below.

- The main purpose of it is to demonstrate your programming and modeling skills.
The assessment will focus primarily on the DDD approach to solving business
problems.

- It is not required to finish the task. Feel free to use as much time as you need.

----
#### Uwagi:
- Domena problemu nie jest typowa - nie mam doświadczenia w tej dziedzinie. Bez większego opisu słowno muzycznego, 
na podstawie samych reguł trudno mi było ją zrozumieć i od razu dobrze zamodelować. Postawiłem więc na rozpoznanie bojem i nadzieję, że 
wraz z implementacją kolejnych elementów zależności się przede mną odsłonią. 
- Całość rozumowania można przesledzić przeglądajac kolejne commity -> `git log`. starałem się były dość krótkie i opisywały kolejne kroki
- Kilku krotnie musiałem się z pewnych rozwiązań wycofywać - co widać w historii commitów.
- Zakładam, że w toku normalnej pracy byłaby bierząca możliwość konsultacji z kimś o większej wiedzy domenowej. Dalej np. nie wiem co jest pierwsze czy jajko czy kura. Czy może istnieć assessment w stanie bez ewaluacji np.? No ale przy zadaniu rekrutacyjnym założyłem że szkoda o to dupy zawracać.
- Głęboko wziałem sobie do serca, że `It is not required to finish the task`, więc nie robiłem go po kolei, wiele elementów pomijałem na początku by nie zagrzebać się w oczywistych detalach.
- Po pobierznym zapoznaniu się z regułami uznałem, że chcę najpierw doprowadzić do przedstawienia assessmentu bez zakamuflowanej wewnątrz maszyny stanów i masy ifologi na metodach.
- Jestem świadomy zastosowania wielu skrótów i uproszczeń - możemy o nich porozmawiać. Zakładam, że zadanie rekrutacyjne rządzi się swoimi prawami.

Sposób uruchomienia:
```
$ docker-compose up --build -d
$ docker-compose run php composer test
```