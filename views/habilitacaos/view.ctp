<div class="habilitacaos view">
    <h2><?php __('Habilitação'); ?>&nbsp;&nbsp;&nbsp;
        <?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt' => __('Índice', true), 'border' => '0', 'title' => 'Índice')), array('action' => 'index', null), array('escape' => false, 'escape' => false), null, false); ?>
    </h2>
    <dl><?php $i = 0;
        $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $this->Html->link($habilitacao['Militar']['Posto']['sigla_posto'] . ' ' . $habilitacao['Militar']['Especialidade']['nm_especialidade'] . ' ' . $habilitacao['Militar']['nm_completo'], array('controller' => 'militars', 'action' => 'view', $habilitacao['Militar']['id'])); ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Cht'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['cht']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Validade Cht'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['validade_cht']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Funcao'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['funcao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Localidade'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['localidade']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Data Concessão'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['dt_concessao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Responsável Concessão'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['responsavel_concessao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Data Suspensão'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['dt_suspensao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Responsável Suspensão'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['responsavel_suspensao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Motivo Suspensão'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['motivo_suspensao']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Data Perda'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['dt_perda']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Responsável Perda'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['responsavel_perda']; ?>
        </dt>
        <dt<?php if ($i % 2 == 0)
                echo $class; ?>><?php __('Motivo Perda'); ?>:&nbsp;&nbsp;&nbsp;
            <?php echo $habilitacao['Habilitacao']['motivo_perda']; ?>
        </dt>
    </dl>
    <?php
    if (!empty($habilitacao['Historico'])) {
        echo "<b>Historico de Revalida&ccedil;&otilde;es:</b><br>";
        ?>
        <div class="related">
            <h3><?php echo 'Quantidade: ( ' . count($habilitacao['Historico']) . ' )';
        ?><?php __(' Hist&oacute;ricos Relacionados'); ?></h3>
            <?php if (!empty($habilitacao['Historico'])): ?>
                <table cellpadding = "0" cellspacing = "0">
                    <tr>
                        <th>Data da Altera&ccedil;&atilde;o</th>
                        <th>Alterado Por</th>
                        <th>CHT</th>
                        <th>Validade</th>
                        <th>Fun&ccedil;&atilde;o</th>
                        <th>Localidade</th>
                        <th>Data da Concess&atilde;o</th>
                        <th>Responsável Concessão:   </th>
                        <th>Data Suspensão:   </th>
                        <th>Responsável Suspensão:   </th>
                        <th>Motivo Suspensão:   </th>
                        <th>Data Perda:   </th>
                        <th>Responsável Perda:   </th>
                        <th>Motivo Perda: </th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($habilitacao['Historico'] as $historico) {
                        $class = null;
                        if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                        }
                        ?>
                        <tr<?php echo $class; ?>>
                            <td><?php echo $historico['dataAlteracao']; ?></td>
                            <td><?php echo $historico['nomeUsuario']; ?></td>
                            <td><?php echo $historico['cht']; ?></td>
                            <td><?php echo $historico['validade_cht']; ?></td>
                            <td><?php echo $historico['funcao']; ?></td>
                            <td><?php echo $historico['localidade']; ?></td>
                            <td><?php echo $historico['dt_concessao']; ?></td>
                            <td><?php echo $historico['responsavel_concessao']; ?></td>
                            <td><?php echo $historico['dt_suspensao']; ?></td>
                            <td><?php echo $historico['responsavel_suspensao']; ?></td>
                            <td><?php echo $historico['motivo_suspensao']; ?></td>
                            <td><?php echo $historico['dt_perda']; ?></td>
                            <td><?php echo $historico['responsavel_perda']; ?></td>
                            <td><?php echo $historico['motivo_perda']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php endif; ?>
        </div><?php
    } else {
        echo "Sem Hist&oacute;ricos de revalida&ccedil;&atilde;o.";
    }
        ?>
</div>
<br>
