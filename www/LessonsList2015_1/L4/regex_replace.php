<?php
require_once '../common.php';

print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';

$text = <<<AAA
<p align="justify">Это история о храбрости и великой силе любви. 
	-подводник Джей Финнел вместе с женой исследует затонувшее торговое судно XVIII века. 
Однажды, пытаясь спасти супругу, он получает опасное ранение и впадает в кому. 
Борясь со смертью, герой переступает грань реальности и переносится в Индию 1778 года, 
где начинает жить жизнью британского офицера Джеймса Стюарта, поглощенного страстью к прекрасной воительнице Туладже.
</p></li><li><b>В ролях:</b>&nbsp;<a href="/star/56244/">Джош Хартнетт</a>, 
	<a href="/star/32018/">Тэмзин Эджертон</a>, <a href="/star/619670/">Элис Энглерт</a>, 
		<a href="/star/2067223/">Махеш Джаду</a>, <a href="/star/17169/">Ом Пури</a>, 
<a href="/star/80963/">Симона Кэссел</a>, <a href="/star/30783/">Темина Санни</a>,
<a href="/star/141329/">Бипаша Басу</a>, <a href="/star/3216917/">Andrea Deck</a>, 
<a href="/star/391308/">Джеймс Маккэй</a> <a href="/film/414609/star/">...&nbsp;»</a>
</li></ul></div></div><br><div class="row"><div class="col-sm-3 text-center">
<a title="Угроза исчезновения видов (1982) - смотреть онлайн" href="/film/99798/">
<img class="img-rounded img-responsive" src="/storage/1164377_210x300x50x2.jpg" alt=""></a>
<div style="margin-top: 8px;"><a data-toggle="modal" href="/film/99798/online/" 
data-target="#onlineModal" data-keyboard="false" data-backdrop="false"><b>Смотреть онлайн &raquo;</b></a>
</div></div><div class="col-sm-9"><span class="pull-right text-right"><b>Добавлен: 23.02.2015</b>
<ul class="list-unstyled text-right"><li><b>Качество:</b> DVDRip</li><li><b>Звук:</b> 
<span title="Профессиональный многоголосый">ПМ</span></li></ul></span><b>
<a title="Угроза исчезновения видов (1982) - смотреть онлайн" href="/film/99798/">Угроза исчезновения видов / Endangered Species</a>
</b><ul class="list-unstyled"><li><b>Жанр:</b>&nbsp;<a href="/film/aa/">Фантастика</a>, <a href="/film/ai/">Триллер</a>, 
<a href="/film/ad/">Драма</a>, <a href="/film/aj/">Детектив</a>.</li><li><b>Год:</b>&nbsp;<a href="/film/i1j2/">1982</a>.
</li><li><b>Страна:</b>&nbsp;<a href="/film/f3/">США</a>.</li><li><b>Режиссер:</b>&nbsp;<a href="/star/21928/">Алан Рудольф</a>		
AAA;



$regex = '#<a|img[\s\S]*>#mU';
$replacement = '';
$clean = preg_replace($regex, $replacement, $text);
p($clean );

$regex = '#<([\s\S]+)>#mU';
$replacement = '[${1}]';
$reformated = preg_replace($regex, $replacement, $text);
p($reformated);

