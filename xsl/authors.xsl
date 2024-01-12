<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:include href="include.xsl" />
	
	<!-- The following trick is called the Muenchian Method -->
	<xsl:key name="articles-by-author" match="article" use="author" />
	<xsl:key name="first-letter" match="article" use="substring(author/familye,1,1)" />
	<xsl:variable name="alephbeyz" select="'אבגדהוװזחטיכלמנסעפצקרשת'" />
	
	<xsl:template match="zhurnaln">
		<ul class="zhurnal author-index">
		<xsl:call-template name="listing">
			<xsl:with-param name="current-letter" select="1" />
		</xsl:call-template>
		</ul>
	</xsl:template>
	
	<xsl:template name="listing">
		<xsl:param name="current-letter" select="1" />
		<xsl:if test="$current-letter &lt;= string-length($alephbeyz)">
			<xsl:if test="count(key('first-letter', substring($alephbeyz,$current-letter,1)))">
				<li>
				<div class="zhurnal index-letter">
				<xsl:value-of select="substring($alephbeyz,$current-letter,1)"/>
				</div>

				<ul class="zhurnal letter-listing">
				<xsl:for-each select="//article[count(. | key('first-letter', substring($alephbeyz,$current-letter,1))) = count(key('first-letter', substring($alephbeyz,$current-letter,1))) and author and count(. | key('articles-by-author', author)[1]) = 1]">
					<xsl:sort select="concat(author/familye,author/rest)" />
					<li>
					<span class="author-name">
					<xsl:value-of select="author/familye"/>
					<xsl:if test="author/rest">
						<xsl:text>, </xsl:text>
						<xsl:value-of select="author/rest" />
					</xsl:if>
					</span>
					<xsl:call-template name="authors-articles">
						<xsl:with-param name="author" select="author"/>
					</xsl:call-template>
					</li>
				</xsl:for-each>
				</ul>
				</li>
			</xsl:if>
		
			<xsl:call-template name="listing">
				<xsl:with-param name="current-letter"
				select="$current-letter+1" />
			</xsl:call-template>
			
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="authors-articles">
		<xsl:param name="author" />
		<ul class="zhurnal article-listing">
			<xsl:for-each select="//article[author=$author]">
				<li>
					<xsl:call-template name='article-link' />
					<xsl:call-template name='numer-zaytl' />
				</li>
			</xsl:for-each>
		</ul>
	</xsl:template>
</xsl:stylesheet>