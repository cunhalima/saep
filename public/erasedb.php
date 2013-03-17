<?php
/* Codificação UTF-8 */
require_once 'inc/inc.php';
//COM_header();
//ADMIN_check();
DB_connect();
HTML_header();
?>
<?php
    $sql = 'drop table if exists usuario, juiz, cargo_juiz, periodo_interrup, pena_aplic,
            processo_cond, decis_st, decis_comut, decis_remicao, apenado, regime_pris, unid_pris;
    create table unid_pris (
        sigla integer not null,
        nome varchar(45) not null,
        primary key(sigla)
    );
    create table regime_pris (
        sigla tinyint(1) not null,
        nome varchar(45) not null,
        primary key(sigla)
    );
    create table apenado (
        codigo integer not null auto_increment,
        codsaj integer,
        unid_pris_sigla integer,
        regime_pris_sigla tinyint,
        nome varchar(45) not null,
        sexo tinyint(1),
        pai varchar(45),
        mae varchar(45),
        nacionalidade varchar(45),
        dtnasc date,
        outro_nome varchar(45),
        data_tp date,
        data_lc date,
        liv_condicional tinyint(1),
        data_pr date,
        ipen varchar(20),
        bairro varchar(45),
        complemento varchar(45),
        logradouro varchar(45),
        telefone varchar(20),
        numero_casa varchar(20),
        estado char(2),
        cidade varchar(45),
        preso_outro_proc varchar(45),
        sursis tinyint(1),
        data_prox_st date,
        primary key(codigo),
        foreign key(regime_pris_sigla) references regime_pris(sigla) on delete set null on update cascade,
        foreign key(unid_pris_sigla) references unid_pris(sigla) on delete set null on update cascade
    );
    create table decis_remicao (
        data_homolog date not null,
        apenado_codigo integer not null,
        dias_trab integer,
        sobra_dias integer,
        dias_remidos integer,
        primary key(data_homolog,apenado_codigo),
        foreign key(apenado_codigo) references apenado(codigo) on delete cascade on update cascade
    );
    create table decis_comut (
        data_decis date not null,
        apenado_codigo integer not null,
        penac_anos integer,
        penac_meses integer,
        penac_dias integer,
        decreto varchar(20),
        primary key(data_decis,apenado_codigo),
        foreign key(apenado_codigo) references apenado(codigo) on delete cascade on update cascade
    );
    create table decis_st (
        data_inicio date not null,
        apenado_codigo integer not null,
        dias integer,
        primary key(data_inicio,apenado_codigo),
        foreign key(apenado_codigo) references apenado(codigo) on delete cascade on update cascade
    );
    create table processo_cond (
        pec varchar(15) not null,
        apenado_codigo integer not null,
        numero_acao_penal varchar(45),
        data_primpris date,
        primary key(pec),
        foreign key(apenado_codigo) references apenado(codigo) on delete cascade on update cascade
    );
    create table pena_aplic (
        pec varchar(15) not null,
        data_fato date not null,
        capitulacao varchar(45),
        reincidencia tinyint(1),
        subst_restritiva tinyint(1),
        hediondez tinyint(1),
        revog_lc tinyint(1),
        pena_anos integer,
        pena_meses integer,
        pena_dias integer,
        primary key(pec,data_fato),
        foreign key(pec) references processo_cond(pec) on delete cascade on update cascade
    );
    create table periodo_interrup (
        apenado_codigo integer not null,
        inicio date not null,
        fim date not null,
        primary key(apenado_codigo,inicio),
        foreign key(apenado_codigo) references apenado(codigo) on delete cascade on update cascade
    );
    create table cargo_juiz (
        sigla tinyint not null,
        nomem varchar(45) not null,
        nomef varchar(45) not null,
        primary key(sigla)
    );
    create table juiz (
        codigo integer not null auto_increment,
        cargo tinyint,
        nome varchar(45) not null,
        sexo char not null,
        primary key(codigo),
        foreign key(cargo) references cargo_juiz(sigla) on delete set null on update cascade
    );
    create table usuario (
        nome varchar(12) not null,
        senha varchar(32),
        juiz integer,
        primary key(nome),
        foreign key(juiz) references juiz(codigo) on delete set null on update cascade
    );
    insert into cargo_juiz (sigla, nomem, nomef) values
        ("1", "Juiz de Direito", "Juíza de Direito"),
        ("2", "Juiz Substituto", "Juíza Substituta");
    insert into juiz (codigo, cargo, nome, sexo) values
        ("1", "1", "Maria Joaquina", "2"),
        ("2", "2", "Gepeto da Silva", "1");
    insert into usuario (nome, senha, juiz) values
        ("admin", "1234", NULL),
        ("alex", "1234", "2");
    insert into unid_pris (sigla, nome) values
        ("1", "Penitenciária Agrícola de Chapecó"),
        ("2", "Presídio Regional de Chapecó"),
        ("3", "Segundo Batalhão de Polícia Militar");
    insert into regime_pris (sigla, nome) values
        ("1", "Fechado"),
        ("2", "Semiaberto"),
        ("3", "Aberto"),
        ("4", "Solto");
    insert into apenado (unid_pris_sigla, regime_pris_sigla, nome) values
        ("1", "2", "Alberto da Silva");
    ';
    
    $sql = str_replace("\n", ' ', $sql);
    $sql = str_replace("\r", ' ', $sql);
    $sql = preg_replace('!\s+!', ' ', $sql);
    $sql = explode(";", $sql);
    //echo '<pre>';
    foreach ($sql as $key => $val) {
        $val = trim($val);
        if ($val != '') {
            //echo "####";
            //echo $val;
            if (!mysql_query($val))
                echo mysql_error();
            //echo "....";
        }
    //mysql_query($val);
    }
    //echo '</pre>';



    echo 'Banco de dados restauradao.'
?>

<?php
//COM_footer();
HTML_footer();
?>
