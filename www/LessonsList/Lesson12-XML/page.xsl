<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output 
  method="html"
  encoding="utf-8"
  omit-xml-declaration="no"
  indent="yes"
  media-type="text/xml"
  doctype-public="-//W3C//DTD XHTML 1.1//EN"
  doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"
/>

<!--
method="xml" - метод вывода документа. Результирующий документ будет в формате XML.
encoding="utf-8" - кодировка результирующего документа.
omit-xml-declaration="no" - пропускать или нет начальное объявление XML-документа (<?xml ... ?>). 
Может иметь значение "yes" или "no" (актуально только для html).
indent="yes" - формировать отступы согласно уровню вложенности. Может иметь значение "yes" или "no".
media-type="text/xml" - MIME-тип результирующего документа (используется только для метода вывода html).
doctype-public="-//W3C//DTD XHTML 1.1//EN" - тип результируюшего документа (DOCTYPE)
doctype-system="http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" - ссылка на DTD
-->

<xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
	<head>
		<title><xsl:value-of select="//title"/></title>
	</head>
	<body>
		<h3><xsl:text>Тестовая страница</xsl:text></h3>
		<div class="menu">
			Menu:
			<xsl:for-each select="/page/menu/menu-item">
				<a>
					<xsl:attribute name="href"><xsl:value-of select="@url" /></xsl:attribute>
					<xsl:value-of select="@text" />
				</a> | 
			</xsl:for-each>
		</div>
		<div class="content">
			<xsl:for-each select="/page/paragraph">
				<div class="paragraph">
					<xsl:attribute name="style" >
						color:<xsl:value-of  select="@color" />; 
					</xsl:attribute>
					<h4>
						<xsl:value-of select="position()" /> 
						<xsl:text> ) </xsl:text>
						<xsl:value-of  select="title" />
					</h4>
					<p>
						<xsl:value-of  select="text" />
					</p>
				</div>
			</xsl:for-each>
		</div>
	</body>
</html>

</xsl:template>

</xsl:stylesheet>