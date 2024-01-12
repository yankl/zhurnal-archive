<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" encoding="UTF-8"
	indent="yes" omit-xml-declaration="yes"/>
	
	<xsl:include href="include.xsl" />
	<!-- The following trick is called the Muenchian Method -->
	<xsl:key name="tags" match="tag" use="." />
	<xsl:key name="first-letter" match="tag" use="substring(.,1,1)" />
	<xsl:variable name="alephbeyz" select="'אבגדהוװזחטיכלמנסעפצקרשת'" />
	
	<xsl:template match="zhurnaln">
		<ul class="zhurnal tag-index">
		<xsl:call-template name="listing">
			<xsl:with-param name="current-letter-position" select="1" />
		</xsl:call-template>
		</ul>
	</xsl:template>
	
	<xsl:template name="listing">
		<xsl:param name="current-letter-position" select="1" />
		<xsl:variable name="current-letter" select="substring($alephbeyz,$current-letter-position,1)" />
		<xsl:if test="$current-letter-position &lt;= string-length($alephbeyz)">
			<xsl:if test="count(key('first-letter', $current-letter))">
				<li>
				<div class="zhurnal index-letter">
				<xsl:value-of select="$current-letter"/>
				</div>

				<ul class="zhurnal letter-listing">
				<xsl:for-each select="key('first-letter', $current-letter)">
				<xsl:sort select="tag" />
				<xsl:if test="count(. | key('tags', .)[1]) = 1">
					<li>
					<span class="zhurnal tag">
					<xsl:value-of select="."/>
					</span>
					<xsl:call-template name="tag-articles">
						<xsl:with-param name="tag" select="."/>
					</xsl:call-template>
					</li>
				</xsl:if>
				</xsl:for-each>
				</ul>
				</li>
			</xsl:if>
		
			<xsl:call-template name="listing">
				<xsl:with-param name="current-letter-position"
				select="$current-letter-position+1" />
			</xsl:call-template>
			
		</xsl:if>
	</xsl:template>
	
	<xsl:template name="tag-articles">
		<xsl:param name="tag" />
		<ul class="zhurnal article-listing">
			<xsl:for-each select="//article[tag=$tag]">
				<li>
					<xsl:call-template name='article-link' />
					<xsl:call-template name='author' />
					<xsl:call-template name='numer-zaytl' />
				</li>
			</xsl:for-each>
		</ul>
	</xsl:template>
	
</xsl:stylesheet>