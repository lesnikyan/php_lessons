
Автор: Sergio.Lesnik@gmail.com

Т.к. было выложено несколько копий, актуальная будет обновляться на github: 
https://github.com/lesnikyan/php_lessons/  в директории /www/mvc-project/

и в новой директории Google Drive:
https://drive.google.com/folderview?id=0B4Y_0UyYEJFTQ19RTWZnYWs4ckk&usp=sharing

---
1. Чтоэта?
	Это имитация MVC веб-фреймворка, или MVC фреймворк минимальной комплектации.

2. Состав:
---
	a) Ядро (Core) системы, выполняющее функцию единого контейнера системных классов, логики исполнения, интерфейса конфигурационного "словаря" и фабрики основных объектов: шаблонов, моделей. Ядро содержит все ключевые объекты, включая статический экцемпляр-синглтон класса Core и предоставляет интерфейс к удобному их использованию путем вызова статических методов.
---	
	b) Маршрутизатор (роутер), позволяющий работать с урлами вида /sermeng1/segment2/.../segmentN
		Где segment1 - определяет целевой контроллер, а
		segment2 - целевой метод контроллера.
		В рамках Core - self::$router;
		На данный момент используется прямой вызов скрипта index.php, путь от имени домена к index.php (включительно) принимается как базовый путь сайта (base_path). все, что содержится за ним используется маршрутизатором для построения вызова целевого кода.
---	
	c) Конфиг. На данный момент - ассоциативный массив, загружаемый из /config.php , и хранящийся в свойстве ядра. Метод Core::conf('key') предоставляет глобальный доступ на чтение параметров конфигурации.
---	
	d) Controller - базовый класс контроллера. Конкретный контроллер - класс-потомок Controller-а, представляющий некоторый контекст, как правило, отвечающий за тематический функционал или раздел верхнего уровня сайта. Класс содержит набор методов, реализующих весь необходимый функционал. В общем случае, контроллеру соответствует первый сегмент URL , методу контроллера - второй сегмент. Остальные сегменты передаются в метод контроллера как его параметры при вызове.
	Код контроллера физически находится в файле с именем контроллера, например users.php для 'domain.com{/base_path}/users/', в директории /application/controller/ . В итоге, для урла /users/view/123/ будет загружен соотв. файл и создан экземпляр класса UsersController, после чего вызван метод 'view' с указанным параметром. Условный аналог кода:  (new UsersController())->view(123).
	Если не указан первый сегмент - вызывается $conf['default_controller']. // main
	Если не указан второй сегмент - вызывается $conf['default_method']. // index
	Метод index() содержится в базовом классе и может переопределяться, как метод без параметров.
	
	e) View (представление). Нативный шаблонизатор, использующий "короткий" синтаксис php в файлах шаблонов. Экземпляр шаблонизатора создается статическим методом Core::view, в качестве параметров передаются имя шаблона и ассоциативный массив связанных значений: 
		$view = Core::view('main', array('title' => 'Hello user!', 'valueName' => $value)).
	Каждая пара из массива значений будет при выполнении шаблона преобразована в соотв. переременую шаблона: 
	<h1><?= $title?></h1>
	
		Методы шаблонизатора:
		$view->setData($data); // устанавливает новый набор связанных значений, удаляя предыдущий.
		$view->render(boolean $output = false); // выполняет шаблон, возвращая сгенерированный HTML (или иной код) в виде строки. Необязательный параметр $output указывает шаблонизатору отправить сгенерированный код в поток вывода.
		upd. Добавлен setter, теперь можно добавлять или заменять связанные значения шаблона через:
			$view->valueName = $value;
---
	f) Model (модель). Базовый класс для моделей. Модели создаются статическим методом ядра Core::model('имя_модели'). Физически файлы моделей находятся в директории /applications/models/.
	Имя файла соответствует имени модели, Класс модели имеет суффикс 'Model', начинается с большой буквы.
	Core::model('users') -->> new UsersModel();
	В конструкторе модели должен быть вызван parent::__constructor($tableName).
	В качестве параметра передается имя целевой таблицы БД.
	
	Методы модели:
	$model->create($data); // создает запись по списку значений полей $data = ['field' => 'value', ..]
	$model->read($id); // возвращает строку из БД по ид.
	$model->update($id, $data); // изменяет строку в БД по ид.
	$model->delete($id); // удаляет запись по ид.
	$model->all(int $from=0, int $limit=100, boolean $objectFormat=true); // выводит список строк, по указанным ограничениям. параметр $objectFormat управляет форматом вывода (true ? object : array)
	
	Внутреннее свойство модели $this->db - экземпляр класса MysqlDriver ( в случае, если не был добавлен другой, и установлен в параметрах опций БД в конфиге). 
	MysqlDriver - расширение класса PDO, набором методов, удобных для вызова типичный SQL-запросов. Методы:
	
		параметры: 
		$sql - sql запрос, составленный по правилам параметризованных запросов 
		$data - массив значений, соответствующий параметризованному запросу $sql
		$format - определяет формат результата (true ? object : array)
	->select($sql, $data=array(), $format=true); // возвращает список значений. 
	->insert($sql, $data=array());	// возвращает ИД добавленной записи
	->update($sql, $data=array()); // возвращает количество измененных строк
	->delete($sql, $data=array()); // взыращает количество удаленных строк

---	
	2. Общая стратегия использования.
		1. Добавление нового функционала. Первым делом, добавляется новый контроллер. По мере расширения функционала контроллера, в него добавляются методы. Хорошей практикой будет выносить общий для контекста контроллера функционал в приватные методы класса.
		
		2. Для каждого контроллера может создаваться любое количчество шаблонов (view). Хорошей практикой было бы группировать шаблоны по директориям с именем контроллеров. Экземпляр создается статическим методом ядра $view=Core::view('имя/модели/как/путь'); имя - путь внутри /application/views/ без расширения.
		
		3. Модели создаются по мере добавления новых ключевых таблиц в БД. В общем случае, это совпадает с созданием нового контроллера. Экземпляр модели создается статическим методом $model=Core::model('имя_модели'); имя соответствует имени файла без расширения.
		
		4. Для размещения статики и медиа-файлов используется директория media в корневом каталоге. Содержит подкаталоги для разных типов статики:
		/media
			/css
			/js
			/img
---	
	3. Структура файлов:
	
	index.php	-	стартовый скрипт.
	config.php	-	конфигурация проекта.
	README.txt	-	текстовый мануал.
	
	/lib	-	системные классы "ядра" фреймворка.
	
	/application	-	файлы приложения. (на данный момент содержит некоторое количество кода с примерами)
		/controllers
		/models
		/views
		
	/media		-	статический контент.
		/css
		/js
		/img
	
	
	
	
	
	
	
	
	
	