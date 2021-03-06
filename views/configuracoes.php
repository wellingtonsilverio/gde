<?php

namespace GDE;

define('TITULO', 'Configura&ccedil;&otilde;es da Conta');

require_once('../common/common.inc.php');

?>

<script type="text/javascript">
	// <![CDATA[
	$(document).ready(function() {
		$.guaycuru.tooltip("TT_desativar", "Desativar Conta:", "Ser&aacute; como se voc&ecirc; n&atilde;o existisse no GDE, mas seus dados ser&atilde;o preservados para quando voc&ecirc; quiser voltar.", {});
		$.guaycuru.tooltip("TT_excluir", "Excluir Conta:", "Tem certeza? Absoluta? Caso exclua a conta, n&atilde;o haver&aacute; volta!", {});

		$("#tabs").tabs({});
		Tamanho_Abas('tabs');

		$('#salvar_conta').click(function() {
			if($("input[name='confConta']:checked").val() == 'excluir') {
				$.guaycuru.simnao2('Tem certeza que deseja excluir seu cadastro do GDE?<br />Todos os seus dados ser&atilde;o perdidos <strong>PARA TODA A ETERNIDADE</strong>!', function() {
					$.post('<?= CONFIG_URL; ?>ajax/excluir-conta.php', {tipo: 'excluir'}, function(data){
						$.guaycuru.confirmacao("Seu cadstro foi exclu&iacute;do do GDE!<br />So long, so long, and thanks for all the fish!", "<?= CONFIG_URL; ?>");
					});
				});
			} else if($("input[name='confConta']:checked").val() == 'desativar') {
				$.post('<?= CONFIG_URL; ?>ajax/excluir-conta.php', {tipo: 'desativar'}, function(data){
					$.guaycuru.confirmacao("Sua conta foi desativada!", "<?= CONFIG_URL; ?>");
				});
			} else
				$.guaycuru.confirmacao("Marque a op&ccedil;&atilde;o para desativar / excluir a conta");
		});

		$('#cancelar').click(function() {
			window.location="<?= CONFIG_URL; ?>";
		});

	});
	// ]]>
</script>
<div id="coluna_esquerda_wrapper">
	<div id="perfil_abas">
		<div id="tabs">
			<ul>
				<li><a href="#tab_conta" class="ativo">Configura&ccedil;&atilde;o da Conta</a></li>
			</ul>
			<div id="tab_conta" class="tab_content">
				<table cellspacing="0" class="tabela_bonyta_branca">
					<tr>
						<td>
							<input type="radio" name="confConta" value="excluir" /><label>Deseja excluir sua conta?</label> <span class="formInfo"><a href="#" id="TT_excluir">?</a></span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="radio" name="confConta" value="desativar"/><label>Deseja desativar sua conta?</label> <span class="formInfo"><a href="#" id="TT_desativar">?</a></span>
						</td>
					</tr>
				</table>
				<br />
				<input type="button" id="salvar_conta" name="salvar_conta" class="botao_salvar" value=" " alt="Excluir ou Desativar Perfil" />
			</div>
		</div>
	</div>
</div>
<?= $FIM; ?>
