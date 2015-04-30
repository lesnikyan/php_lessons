CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `email`) VALUES
(1, 'Admin', 'admin', 'qwerty', 'admin@mysite.com'),
(2, 'Semen Petrovich', 'boss', '123', 'SemenMenyalo@mysite.com'),
(3, 'Vasya', 'vasya', '1', 'vasya@gmail.com'),
(4, 'Kolya', 'kalyan', '123', 'kalyan11111@mail.ru'),
(5, 'Angel 17', 'angelochek1990', '111', 'anzhella1990@mail.ru');