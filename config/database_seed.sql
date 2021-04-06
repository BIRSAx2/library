INSERT INTO library.roles
values ('ADMIN', 'Admin user'),
       ('USER', 'Normal user');

INSERT INTO library.authors (first_name, middle_name, last_name, description)
values ('Robert', 'M.', 'Sapolsky',
        'Robert Morris Sapolsky is an American neuroendocrinology researcher and author. He is currently a professor of biology, and professor of neurology and neurological sciences and, by courtesy, neurosurgery, at Stanford University. In addition, he is a research associate at the National Museums of Kenya. '),
       ('David', NULL, 'Quammen',
        'David Quammen is an American science, nature, and travel writer and the author of fifteen books. For 15 years he wrote a column called "Natural Acts" for Outside magazine'),
       ('Haruki', NULL, 'Murakami',
        'Haruki Murakami is a Japanese writer. His books and stories have been bestsellers in Japan as well as internationally, with his work being translated into 50 languages and selling millions of copies outside his native country.'),
       ('Ferenc', NULL, 'Karinthy',
        'Ferenc Karinthy was a Hungarian novelist, playwright, journalist, editor and translator, as well as a water polo champion. He authored more than a dozen novels. His father was the writer and journalist Frigyes Karinthy. His mother, the psychiatrist Aranka Böhm, was killed in 1944 in Auschwitz.'),
       ('Ernest', NULL, 'Hemingway',
        'Ernest Miller Hemingway was an American novelist, short-story writer, journalist, and sportsman. His economical and understated style—which he termed the iceberg theory—had a strong influence on 20th-century fiction, while his adventurous lifestyle and his public image brought him admiration from later generations.');


insert into library.books (title, genre, description)
values ('Behave: The Biology of Humans at Our Best and Worst', 'Science',
        'Behave: The Biology of Humans at Our Best and Worst is a 2017 non-fiction book by Robert Sapolsky.It describes how various biological processes influence human behavior, on scales ranging from less than a second before an action to thousands of years before'),
       ('Spillover: Animal Infections and the Next Human Pandemic', 'Science',
        'Examines the emergence and causes of new diseases all over the world, describing a process called “spillover” where illness originates in wild animals before being passed to humans and discusses the potential for the next huge pandemic. 70,000 first printing.'),
       ('1Q84', 'Novel',
        '1Q84 is a novel written by Japanese writer Haruki Murakami, first published in three volumes in Japan in 2009–10. It covers a fictionalized year of 1984 in parallel with a "real" one. The novel is a story of how a woman named Aomame begins to notice strange changes occurring in the world. '),
       ('Épépé', 'Novel',
        'Epepe, written in 1970, is the first of Karinthy\'s novels to be translated into English, appearing as Metropole in 2008.   This essentially Kafkaesque tale follows the travails of Budai, a linguist who steps off a plane expecting to be in Helsinki but finds himself in a sprawling and densely populated metropolis whose residents speak an unknown and unintelligible language. Budai is swept along with the crowd to a hotel, where he tries in vain to explain his predicament.'),
       ('The Old Man and the Sea', 'Novel',
        'The Old Man and the Sea is a short novel written by the American author Ernest Hemingway in 1951 in Cayo Blanco,and published in 1952. It was the last major work of fiction written by Hemingway that was published during his lifetime.');

insert into library.book_authors (book, author)
values (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (5, 5);

insert into users (user_name, first_name, last_name, password_hash, email)
values ('mouhieddine', 'mouhieddine', 'sabir', '$2y$12$ZFC7Ba.ax5EziH3WxcFMU.izZzBXq68v5p2AQGsSQyfeq/UI4k1Eu',
        'mouhieddinesabir@gmail.com');
