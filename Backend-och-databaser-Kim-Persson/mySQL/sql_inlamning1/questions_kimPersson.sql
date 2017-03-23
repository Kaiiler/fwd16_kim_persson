// Hur många av olika rang?

SELECT COUNT(*), Rank FROM crew GROUP BY Rank;

// Hur många som tillhör olika typer av avdelningar.

SELECT COUNT(*), department FROM crew GROUP BY department;

// Kunna söka på för en viss rang?

SELECT * FROM crew WHERE rank = 1;

// Lista alla som tjänar mer än en viss (valfri) summa.

SELECT firstName, lastName, rank, rank.salary FROM crew INNER JOIN Rank = rank.rankID WHERE (rank.salary > 20000);

// Lista antal utav hela besättningen.

SELECT COUNT(*), crewID FROM crew;

// Hur många är listade som avlidna

SELECT COUNT(*), status FROM crew WHERE status = 0;



