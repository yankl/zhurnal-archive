<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>
	<xsl:template match="/zhurnaln">
		<html>
			<head>
				<title>Zhurnal Search</title>
			</head>
			<body dir='rtl'><xsl:apply-templates/></body>
		</html>
	</xsl:template>
	<xsl:template match="issue">
		<h1>Issue</h1><xsl:apply-templates/>
	</xsl:template>
	<xsl:template match="article">
		<xsl:apply-templates/><br/>
	</xsl:template>
	<xsl:template match="title">
		<a href='zhurnal.php?numer=???#page/???/mode/2up'><xsl:apply-templates/></a>
	</xsl:template>
	<xsl:template match="author">
		fun <xsl:apply-templates/>
	</xsl:template>
</xsl:stylesheet>