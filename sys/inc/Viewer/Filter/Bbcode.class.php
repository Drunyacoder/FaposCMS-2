<?php
/*---------------------------------------------\
|											   |
| @Author:       Andrey Brykin (Drunya)        |
| @Email:        drunyacoder@gmail.com         |
| @Site:         http://atomx.net              |
| @Version:      1.0                           |
| @Project:      CMS                           |
| @Package       AtomX CMS                     |
| @Subpackege    Bbcode filter                 |
| @Copyright     ©Andrey Brykin 2010-2014      |
| @Last mod      2014/04/14                    |
|----------------------------------------------|
|											   |
| any partial or not partial extension         |
| CMS AtomX,without the consent of the         |
| author, is illegal                           |
|----------------------------------------------|
| Любое распространение                        |
| CMS AtomX или ее частей,                     |
| без согласия автора, является не законным    |
\---------------------------------------------*/

class Fps_Viewer_Filter_Bbcode {


	public function compile($value, Fps_Viewer_CompileParser $compiler)
	{
        if (!is_callable($value)) throw new Exception('(Filter_Bbcode):Value for filtering must be callable.');

        $compiler->raw('Register::getInstance()->PrintText->parseBBCodes(');
        $value($compiler);
		if (!empty($this->params[0])) {
			$compiler->raw(', ');
			$this->params[0]->compile($compiler);
		}
        $compiler->raw(')');
	}
	

    public function addParam($param)
    {
        $this->params[] = $param;
    }
	
	
	public function __toString()
	{
		$out = '[filter]:bbcode' . "\n";
		return $out;
	}
}