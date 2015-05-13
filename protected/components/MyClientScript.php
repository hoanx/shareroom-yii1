<?php
class MyClientScript extends CClientScript {

	protected $activeScriptId;
	protected $activeScriptPosition;

	public function beginScript($id, $pos = parent::POS_READY) {

		$this->activeScriptId = $id;
		$this->activeScriptPosition = $pos;

		ob_start();
		ob_implicit_flush(false);
	}

	public function endScript() {

		$script = ob_get_clean();
		$script = strip_tags($script, '<p><a><br><span><div><b><i><strong>');
		parent::registerScript($this->activeScriptId, $script, $this->activeScriptPosition);

	}
}


