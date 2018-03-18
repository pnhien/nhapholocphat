<?php
App::import('Controller', 'GetRssNews');
class GetRssNewsShell extends AppShell {
    public function main() {
		$getRssNews = new GetRssNewsController ();
		$getRssNews->getRssNewsUser();
    }
}
?>