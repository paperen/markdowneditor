# markdowneditor #
һ���򵥵�markdown�༭��

@author [paperen](http://iamlze.cn "paperen")

@url [����markdowneditor.rar](http://iamlze.cn/demo/markdowneditor/markdowneditor.rar "����")

@link [http://iamlze.cn/markdowneditor](http://iamlze.cn/markdowneditor "markdowneditor")

## ����markdown ##
>Markdown ��Ŀ����ʵ�֡��׶���д����
>�ɶ��ԣ�������Σ���������Ҫ�ġ�һ��ʹ�� Markdown ��ʽ׫д���ļ�Ӧ�ÿ���ֱ���Դ��ı����������ҿ�������������������ǩ���Ǹ�ʽָ�������ɡ�Markdown �﷨�ܵ�һЩ���� text-to-HTML ��ʽ��Ӱ�죬���� Setext��atx��Textile��reStructuredText��Grutatext �� EtText������������Դ��ʵ�Ǵ��ı������ʼ��ĸ�ʽ��
>��֮�� Markdown ���﷨ȫ��һЩ��������ɣ���Щ���ž�������ϸѡ��������һĿ��Ȼ�����磺���������Լ����Ǻţ�����������*ǿ��*��Markdown ���б��������ţ������б�Markdown ���������ÿ������������������һ�����֣����������ڵ����ʼ��м�����������

����ժ��[http://wowubuntu.com/markdown/#philosophy](http://wowubuntu.com/markdown/#philosophy "markdown��ּ")

## ֧�ֵ��ȼ��б� ##
* __alt+shift+a__ ��������
* __alt+shift+p__ Ԥ��
* __alt+shift+u__ �ϴ��ļ�

## ������ ##
* __editor_relpath__ markdown�༭�����·�� (Ĭ��ֵ_./markdowneditor/_)
* __id__ �༭��ID (Ĭ��ֵ_content_)
* __name__ �༭������ (Ĭ��ֵ_content_)
* __value__ �༭��Ĭ������ (Ĭ��ֵ _��_)
* __preview__ �Ƿ���Ԥ�� (Ĭ��ֵ _true_)
* __upload__ �Ƿ����ϴ��ļ� (Ĭ��ֵ _true_)
* __upload_path__ �ļ��ϴ�����Ŀ¼ (Ĭ��ֵ _./upload/_)
* __upload_handler__ �ļ��ϴ�����ű��ļ� (Ĭ��ֵ _./upload/upload.php_)

�����ͨ��MarkdownEditor::renderʱ����Ĭ�ϵ����ò���

	<?php
	 = array(
		'upload_handler' => './upload.php',
		'upload_path' => './upload/',
		'value' => ,
	);
	MarkdownEditor::render(  );
	?>

## API ##
* MDE_insertLink ��������
* MDE_preview Ԥ��
* MDE_upload ִ���ϴ�
* MDE_parse ת��markdown
* MDE_insertAtCursor( text ) ���༭��������λ�ò���text
* MDE_insertFile( filename ) ���༭��������λ�ò���filename

## ע�� ##
*	�����ϴ����ڴ˴��ϴ���û��Ч���ģ�ʼ�ն���test.png����Ȼ paperen�����ܻ���������ϴ��ļ����ҵĿռ�����Ҫ�ԵĻ��Լ����������޸�upload.php�ļ�������7�е�

		define( 'UPLOAD_DISABLED', TRUE );

	UPLOAD_DISABLED������ΪFALSE����Ȼ��Ҳ���Ը����Լ���������дupload.php�Ĵ���

*	��д��tab�� �ڱ༭���а���tab�ر��һ���Ʊ��\t
*	����HTML

