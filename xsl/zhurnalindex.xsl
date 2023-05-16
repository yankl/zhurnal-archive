<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>	
	
	<xsl:include href="include.xsl" />
	
	<xsl:template match="zhurnaln">
		<div class='zhurnaln'><xsl:apply-templates/></div>
	</xsl:template>
		
		
	<xsl:template match="issue">
		<h2><a href='/zhurnal/zhurnal.php?numer={@num}#mode/2up' class="zhurnal-article-title">נומער <xsl:value-of select="@num" /></a></h2>
		
		<ol class="zhurnal-index"><xsl:apply-templates/></ol>
		
	</xsl:template>
	
	<xsl:template match="article">
		<li>
			<xsl:call-template name='article-link' />
			<xsl:call-template name='author' />

		</li>
	</xsl:template>	
	
</xsl:stylesheet>