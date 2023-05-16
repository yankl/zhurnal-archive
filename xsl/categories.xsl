<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:include href="include.xsl" />
	
	<!-- The following trick is called the Muenchian Method -->
	<xsl:key name="articles-by-category" match="article" use="@category" />
	
	<xsl:template match="zhurnaln">
		<ul class="zhurnal category-index">
			<xsl:for-each select="//article[@category and count(. | key('articles-by-category', @category)[1]) = 1]">
			<xsl:sort select="@category" />
			<li>
			<span class="category-name">
			<xsl:value-of select="@category" />
			</span>
			<xsl:call-template name="category-articles">
				<xsl:with-param name="category" select="@category" />
			</xsl:call-template>
			</li>
			</xsl:for-each>
		</ul>
	</xsl:template>

	<xsl:template name="category-articles">
		<xsl:param name="category" />
			<ul class="zhurnal article-listing">
				<xsl:for-each select="//article[@category=$category]">
				<li>
					<xsl:call-template name='article-link' />
					<xsl:call-template name='author' />
					<xsl:call-template name='numer-zaytl' />
				</li>
				</xsl:for-each>
			</ul>
	</xsl:template>
	
</xsl:stylesheet>