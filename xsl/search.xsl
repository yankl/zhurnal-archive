<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:include href="include.xsl" />
	
	<xsl:param name="search_term" />
	
	<xsl:template match="/">
		<ol>
			<xsl:apply-templates select="//article[contains(., $search_term)]" />
		</ol>
	</xsl:template>
	
	<xsl:template match="article">
		<li>
			<xsl:call-template name='article-link' />
			<xsl:call-template name='author' />
			<xsl:call-template name='numer-zaytl' />
		</li>
	</xsl:template>	
	
</xsl:stylesheet>