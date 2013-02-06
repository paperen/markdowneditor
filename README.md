# markdowneditor #
一个简单的markdown编辑器

@author [paperen](http://iamlze.cn "paperen")

@url [下载markdowneditor.rar](http://iamlze.cn/demo/markdowneditor/markdowneditor.rar "下载")

## 关于markdown ##
>Markdown 的目标是实现「易读易写」。
>可读性，无论如何，都是最重要的。一份使用 Markdown 格式撰写的文件应该可以直接以纯文本发布，并且看起来不会像是由许多标签或是格式指令所构成。Markdown 语法受到一些既有 text-to-HTML 格式的影响，包括 Setext、atx、Textile、reStructuredText、Grutatext 和 EtText，而最大灵感来源其实是纯文本电子邮件的格式。
>总之， Markdown 的语法全由一些符号所组成，这些符号经过精挑细选，其作用一目了然。比如：在文字两旁加上星号，看起来就像*强调*。Markdown 的列表看起来，嗯，就是列表。Markdown 的区块引用看起来就真的像是引用一段文字，就像你曾在电子邮件中见过的那样。

以上摘自[http://wowubuntu.com/markdown/#philosophy](http://wowubuntu.com/markdown/#philosophy "markdown宗旨")

## 支持的热键列表 ##
* __alt+shift+a__ 插入链接
* __alt+shift+p__ 预览
* __alt+shift+u__ 上传文件

## 配置项 ##
* __editor_relpath__ markdown编辑器相对路径 (默认值_./markdowneditor/_)
* __id__ 编辑器ID (默认值_content_)
* __name__ 编辑器名称 (默认值_content_)
* __value__ 编辑器默认内容 (默认值 _空_)
* __preview__ 是否开启预览 (默认值 _true_)
* __upload__ 是否开启上传文件 (默认值 _true_)
* __upload_path__ 文件上传保存目录 (默认值 _./upload/_)
* __upload_handler__ 文件上传处理脚本文件 (默认值 _./upload/upload.php_)

你可以通过MarkdownEditor::render时覆盖默认的配置参数

	<?php
	 = array(
		'upload_handler' => './upload.php',
		'upload_path' => './upload/',
		'value' => ,
	);
	MarkdownEditor::render(  );
	?>

## API ##
* MDE_insertLink 插入链接
* MDE_preview 预览
* MDE_upload 执行上传
* MDE_parse 转换markdown
* MDE_insertAtCursor( text ) 往编辑板光标所在位置插入text
* MDE_insertFile( filename ) 往编辑板光标所在位置插入filename

## 注意 ##
*	关于上传，在此处上传是没有效果的，始终都是test.png，当然 paperen不可能会让你真的上传文件到我的空间来…要试的话自己下载下来修改upload.php文件，将第7行的

		define( 'UPLOAD_DISABLED', TRUE );

	UPLOAD_DISABLED常量改为FALSE，当然你也可以根据自己的需求重写upload.php的代码

*	重写了tab键 在编辑器中按下tab回变成一个制表符\t
*	兼容HTML

