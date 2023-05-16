<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:template name="article-link">
		<a href='/zhurnal/zhurnal.php?ui=embed&amp;numer={../@num}#page/{@page}/mode/1up' class="lbp_secondary zhurnal-article-title"><xsl:value-of select="title" /></a>
	</xsl:template>
	
	<xsl:template name="author">
		<xsl:if test="author">
			<xsl:text> פֿון </xsl:text>
			<a href='/wordpress/wp-content/plugins/zhurnal-archive/single-author-articles.php?familye={author/familye}&amp;rest={author/rest}' class="lbp_secondary by-author">
			<xsl:value-of select="author/rest"/><xsl:text> </xsl:text>
			<xsl:value-of select="author/familye"/></a>
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="numer-zaytl">
		<xsl:text> (נ׳ </xsl:text>
		<xsl:value-of select="../@num" />
		<xsl:text> ,ז׳ </xsl:text>
		<xsl:value-of select="@page" />
		<xsl:text>)</xsl:text>
	</xsl:template>
	
</xsl:stylesheet>