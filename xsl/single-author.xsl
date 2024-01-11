<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:param name="familye" />
	<xsl:param name="rest" />
	
	<xsl:include href="include.xsl" />
	
	<xsl:template match="/">
		<ol>
			<xsl:apply-templates select="//article[author/familye=$familye and author/rest=$rest]" />
		</ol>
	</xsl:template>
	
	<xsl:template match="article">
		<li>
			<xsl:call-template name='article-link' />
			<xsl:call-template name='numer-zaytl' />
		</li>
	</xsl:template>

</xsl:stylesheet>