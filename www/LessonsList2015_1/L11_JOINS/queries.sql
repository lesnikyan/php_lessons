INSERT INTO `php3_test1`.`articles` (`id`, `title`, `content`, `date_created`, `user_id`) 
VALUES (NULL, 'My First article!', 'I so happy writing my first text!!!', CURRENT_TIMESTAMP, '1');

SELECT u.id as uid, u.name, 
a.id  as aid, a.title, a.content, a.date_created as `date`
FROM users u
INNER JOIN articles a ON a.user_id = u.id;


SELECT u.id as uid, u.name, 
a.id  as aid, a.title, a.content, a.date_created as `date`
FROM users u
INNER JOIN articles a ON a.user_id = u.id
WHERE u.id = 1;
