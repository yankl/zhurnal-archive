<?php

namespace Yugntruf\ZhurnalArkhiv\Data;

use \SimpleXMLElement;
use DI\Attribute\Inject;

class LocalDatabase {
	private SimpleXMLElement $xml;
	
	public function __construct (
		#[Inject('xmlpath')] private string $dbPath
	) {
		$this->xml = new SimpleXMLElement('<zhurnaln></zhurnaln>');
	}
	
	public function storeDb($json) {
		$db = json_decode($json);
		
		foreach ($db as $article) {
			$numer = $article->numer;
			$zaytl = $article->zaytl;
			$titl = $article->titl;
			$mekhaber = $article->mekhaber ?? '';
			$kategorye = $article->kategorye ?? '';
			$tags = $article->rubrik ?? [];
			
			$this->addIssue($article->numer);
			$this->addArticletoIssue(
				$numer,
				$zaytl,
				$titl,
				$mekhaber,
				$kategorye,
				$tags
			);
		}
		
		return $this->saveToFile(); //returns true if file was written
	}
	
	private function hasIssue($numer) {
		return (bool) $this->xml->xpath("issue[@num='$numer']");
	}
	
	private function addIssue($numer) {
		if ($this->hasIssue($numer)) return;

		$issue = $this->xml->addChild('issue');
		$issue->addAttribute('num', $numer);
	}
	
	private function addArticletoIssue($numer, $page_num, $title, $author, $category, $tags) {
		$issueEl = $this->getIssueElement($numer);
		
		$articleEl = $issueEl->addChild('article');
		$articleEl->addAttribute('page', $page_num);
		
		$articleEl->addChild('title', $title);
		
		$this->addAuthorToArticle($articleEl, $author);
		
		if ($category) $articleEl->addAttribute('category', $category);
		
		foreach ($tags as $tag) {
			$articleEl->addChild('tag', $tag);
		}
	}
	
	private function addAuthorToArticle($articleEl, $authorName) {
		if (!$authorName) return;
		
		$authorEl = $articleEl->addChild('author');
		
		$namePieces = explode(' ', $authorName);
		
		$familye = array_pop($namePieces);
		$authorEl->addChild('familye', $familye);
		
		if ($rest = implode(' ', $namePieces))
			$authorEl->addChild('rest', $rest);
		
	}
	
	private function getIssueElement($numer) {
		return $this->xml->xpath("issue[@num='$numer']")[0];
	}
	
	private function saveToFile() {
		return $this->xml->saveXML($this->dbPath);
	}
	
	public function loadFromFile() {
		$this->xml = new SimpleXMLElement(file_get_contents($this->dbPath));
	}
	
}