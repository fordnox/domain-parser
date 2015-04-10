<?php
namespace Fordnox;

class DomainParser
{
    private $string = null;

    private $sld = null;

    private $tld = null;

    /**
     * @see https://raw.github.com/gavingmiller/second-level-domains/master/SLDs.csv
     */
    protected $urlMap = array(
        0 => '.com.ac',
        1 => '.net.ac',
        2 => '.gov.ac',
        3 => '.org.ac',
        4 => '.mil.ac',
        5 => '.co.ae',
        6 => '.net.ae',
        7 => '.gov.ae',
        8 => '.ac.ae',
        9 => '.sch.ae',
        10 => '.org.ae',
        11 => '.mil.ae',
        12 => '.pro.ae',
        13 => '.name.ae',
        14 => '.com.af',
        15 => '.edu.af',
        16 => '.gov.af',
        17 => '.net.af',
        18 => '.org.af',
        19 => '.com.al',
        20 => '.edu.al',
        21 => '.gov.al',
        22 => '.mil.al',
        23 => '.net.al',
        24 => '.org.al',
        25 => '.ed.ao',
        26 => '.gv.ao',
        27 => '.og.ao',
        28 => '.co.ao',
        29 => '.pb.ao',
        30 => '.it.ao',
        31 => '.com.ar',
        32 => '.edu.ar',
        33 => '.gob.ar',
        34 => '.gov.ar',
        35 => '.gov.ar',
        36 => '.int.ar',
        37 => '.mil.ar',
        38 => '.net.ar',
        39 => '.org.ar',
        40 => '.tur.ar',
        41 => '.gv.at',
        42 => '.ac.at',
        43 => '.co.at',
        44 => '.or.at',
        45 => '.com.au',
        46 => '.net.au',
        47 => '.org.au',
        48 => '.edu.au',
        49 => '.gov.au',
        50 => '.csiro.au',
        51 => '.asn.au',
        52 => '.id.au',
        53 => '.org.ba',
        54 => '.net.ba',
        55 => '.edu.ba',
        56 => '.gov.ba',
        57 => '.mil.ba',
        58 => '.unsa.ba',
        59 => '.untz.ba',
        60 => '.unmo.ba',
        61 => '.unbi.ba',
        62 => '.unze.ba',
        63 => '.co.ba',
        64 => '.com.ba',
        65 => '.rs.ba',
        66 => '.co.bb',
        67 => '.com.bb',
        68 => '.net.bb',
        69 => '.org.bb',
        70 => '.gov.bb',
        71 => '.edu.bb',
        72 => '.info.bb',
        73 => '.store.bb',
        74 => '.tv.bb',
        75 => '.biz.bb',
        76 => '.com.bh',
        77 => '.info.bh',
        78 => '.cc.bh',
        79 => '.edu.bh',
        80 => '.biz.bh',
        81 => '.net.bh',
        82 => '.org.bh',
        83 => '.gov.bh',
        84 => '.com.bn',
        85 => '.edu.bn',
        86 => '.gov.bn',
        87 => '.net.bn',
        88 => '.org.bn',
        89 => '.com.bo',
        90 => '.net.bo',
        91 => '.org.bo',
        92 => '.tv.bo',
        93 => '.mil.bo',
        94 => '.int.bo',
        95 => '.gob.bo',
        96 => '.gov.bo',
        97 => '.edu.bo',
        98 => '.adm.br',
        99 => '.adv.br',
        100 => '.agr.br',
        101 => '.am.br',
        102 => '.arq.br',
        103 => '.art.br',
        104 => '.ato.br',
        105 => '.b.br',
        106 => '.bio.br',
        107 => '.blog.br',
        108 => '.bmd.br',
        109 => '.cim.br',
        110 => '.cng.br',
        111 => '.cnt.br',
        112 => '.com.br',
        113 => '.coop.br',
        114 => '.ecn.br',
        115 => '.edu.br',
        116 => '.eng.br',
        117 => '.esp.br',
        118 => '.etc.br',
        119 => '.eti.br',
        120 => '.far.br',
        121 => '.flog.br',
        122 => '.fm.br',
        123 => '.fnd.br',
        124 => '.fot.br',
        125 => '.fst.br',
        126 => '.g12.br',
        127 => '.ggf.br',
        128 => '.gov.br',
        129 => '.imb.br',
        130 => '.ind.br',
        131 => '.inf.br',
        132 => '.jor.br',
        133 => '.jus.br',
        134 => '.lel.br',
        135 => '.mat.br',
        136 => '.med.br',
        137 => '.mil.br',
        138 => '.mus.br',
        139 => '.net.br',
        140 => '.nom.br',
        141 => '.not.br',
        142 => '.ntr.br',
        143 => '.odo.br',
        144 => '.org.br',
        145 => '.ppg.br',
        146 => '.pro.br',
        147 => '.psc.br',
        148 => '.psi.br',
        149 => '.qsl.br',
        150 => '.rec.br',
        151 => '.slg.br',
        152 => '.srv.br',
        153 => '.tmp.br',
        154 => '.trd.br',
        155 => '.tur.br',
        156 => '.tv.br',
        157 => '.vet.br',
        158 => '.vlog.br',
        159 => '.wiki.br',
        160 => '.zlg.br',
        161 => '.com.bs',
        162 => '.net.bs',
        163 => '.org.bs',
        164 => '.edu.bs',
        165 => '.gov.bs',
        166 => 'com.bz',
        167 => 'edu.bz',
        168 => 'gov.bz',
        169 => 'net.bz',
        170 => 'org.bz',
        171 => '.ab.ca',
        172 => '.bc.ca',
        173 => '.mb.ca',
        174 => '.nb.ca',
        175 => '.nf.ca',
        176 => '.nl.ca',
        177 => '.ns.ca',
        178 => '.nt.ca',
        179 => '.nu.ca',
        180 => '.on.ca',
        181 => '.pe.ca',
        182 => '.qc.ca',
        183 => '.sk.ca',
        184 => '.yk.ca',
        185 => '.co.ck',
        186 => '.org.ck',
        187 => '.edu.ck',
        188 => '.gov.ck',
        189 => '.net.ck',
        190 => '.gen.ck',
        191 => '.biz.ck',
        192 => '.info.ck',
        193 => '.ac.cn',
        194 => '.com.cn',
        195 => '.edu.cn',
        196 => '.gov.cn',
        197 => '.mil.cn',
        198 => '.net.cn',
        199 => '.org.cn',
        200 => '.ah.cn',
        201 => '.bj.cn',
        202 => '.cq.cn',
        203 => '.fj.cn',
        204 => '.gd.cn',
        205 => '.gs.cn',
        206 => '.gz.cn',
        207 => '.gx.cn',
        208 => '.ha.cn',
        209 => '.hb.cn',
        210 => '.he.cn',
        211 => '.hi.cn',
        212 => '.hl.cn',
        213 => '.hn.cn',
        214 => '.jl.cn',
        215 => '.js.cn',
        216 => '.jx.cn',
        217 => '.ln.cn',
        218 => '.nm.cn',
        219 => '.nx.cn',
        220 => '.qh.cn',
        221 => '.sc.cn',
        222 => '.sd.cn',
        223 => '.sh.cn',
        224 => '.sn.cn',
        225 => '.sx.cn',
        226 => '.tj.cn',
        227 => '.tw.cn',
        228 => '.xj.cn',
        229 => '.xz.cn',
        230 => '.yn.cn',
        231 => '.zj.cn',
        232 => '.com.co',
        233 => '.org.co',
        234 => '.edu.co',
        235 => '.gov.co',
        236 => '.net.co',
        237 => '.mil.co',
        238 => '.nom.co',
        239 => '.ac.cr',
        240 => '.co.cr',
        241 => '.ed.cr',
        242 => '.fi.cr',
        243 => '.go.cr',
        244 => '.or.cr',
        245 => '.sa.cr',
        246 => '.cr',
        247 => '.ac.cy',
        248 => '.net.cy',
        249 => '.gov.cy',
        250 => '.org.cy',
        251 => '.pro.cy',
        252 => '.name.cy',
        253 => '.ekloges.cy',
        254 => '.tm.cy',
        255 => '.ltd.cy',
        256 => '.biz.cy',
        257 => '.press.cy',
        258 => '.parliament.cy',
        259 => '.com.cy',
        260 => '.edu.do',
        261 => '.gob.do',
        262 => '.gov.do',
        263 => '.com.do',
        264 => '.sld.do',
        265 => '.org.do',
        266 => '.net.do',
        267 => '.web.do',
        268 => '.mil.do',
        269 => '.art.do',
        270 => '.com.dz',
        271 => '.org.dz',
        272 => '.net.dz',
        273 => '.gov.dz',
        274 => '.edu.dz',
        275 => '.asso.dz',
        276 => '.pol.dz',
        277 => '.art.dz',
        278 => '.com.ec',
        279 => '.info.ec',
        280 => '.net.ec',
        281 => '.fin.ec',
        282 => '.med.ec',
        283 => '.pro.ec',
        284 => '.org.ec',
        285 => '.edu.ec',
        286 => '.gov.ec',
        287 => '.mil.ec',
        288 => '.com.eg',
        289 => '.edu.eg',
        290 => '.eun.eg',
        291 => '.gov.eg',
        292 => '.mil.eg',
        293 => '.name.eg',
        294 => '.net.eg',
        295 => '.org.eg',
        296 => '.sci.eg',
        297 => '.com.er',
        298 => '.edu.er',
        299 => '.gov.er',
        300 => '.mil.er',
        301 => '.net.er',
        302 => '.org.er',
        303 => '.ind.er',
        304 => '.rochest.er',
        305 => '.w.er',
        306 => '.com.es',
        307 => '.nom.es',
        308 => '.org.es',
        309 => '.gob.es',
        310 => '.edu.es',
        311 => '.com.et',
        312 => '.gov.et',
        313 => '.org.et',
        314 => '.edu.et',
        315 => '.net.et',
        316 => '.biz.et',
        317 => '.name.et',
        318 => '.info.et',
        319 => '.ac.fj',
        320 => '.biz.fj',
        321 => '.com.fj',
        322 => '.info.fj',
        323 => '.mil.fj',
        324 => '.name.fj',
        325 => '.net.fj',
        326 => '.org.fj',
        327 => '.pro.fj',
        328 => '.co.fk',
        329 => '.org.fk',
        330 => '.gov.fk',
        331 => '.ac.fk',
        332 => '.nom.fk',
        333 => '.net.fk',
        334 => '.fr',
        335 => '.tm.fr',
        336 => '.asso.fr',
        337 => '.nom.fr',
        338 => '.prd.fr',
        339 => '.presse.fr',
        340 => '.com.fr',
        341 => '.gouv.fr',
        342 => '.co.gg',
        343 => '.net.gg',
        344 => '.org.gg',
        345 => '.com.gh',
        346 => '.edu.gh',
        347 => '.gov.gh',
        348 => '.org.gh',
        349 => '.mil.gh',
        350 => '.com.gn',
        351 => '.ac.gn',
        352 => '.gov.gn',
        353 => '.org.gn',
        354 => '.net.gn',
        355 => '.com.gr',
        356 => '.edu.gr',
        357 => '.net.gr',
        358 => '.org.gr',
        359 => '.gov.gr',
        360 => '.mil.gr',
        361 => '.com.gt',
        362 => '.edu.gt',
        363 => '.net.gt',
        364 => '.gob.gt',
        365 => '.org.gt',
        366 => '.mil.gt',
        367 => '.ind.gt',
        368 => '.com.gu',
        369 => '.net.gu',
        370 => '.gov.gu',
        371 => '.org.gu',
        372 => '.edu.gu',
        373 => '.com.hk',
        374 => '.edu.hk',
        375 => '.gov.hk',
        376 => '.idv.hk',
        377 => '.net.hk',
        378 => '.org.hk',
        379 => '.ac.id',
        380 => '.co.id',
        381 => '.net.id',
        382 => '.or.id',
        383 => '.web.id',
        384 => '.sch.id',
        385 => '.mil.id',
        386 => '.go.id',
        387 => '.war.net.id',
        388 => '.ac.il',
        389 => '.co.il',
        390 => '.org.il',
        391 => '.net.il',
        392 => '.k12.il',
        393 => '.gov.il',
        394 => '.muni.il',
        395 => '.idf.il',
        396 => '.in',
        397 => '.co.in',
        398 => '.firm.in',
        399 => '.net.in',
        400 => '.org.in',
        401 => '.gen.in',
        402 => '.ind.in',
        403 => '.ac.in',
        404 => '.edu.in',
        405 => '.res.in',
        406 => '.ernet.in',
        407 => '.gov.in',
        408 => '.mil.in',
        409 => '.nic.in',
        410 => '.nic.in',
        411 => '.iq',
        412 => '.gov.iq',
        413 => '.edu.iq',
        414 => '.com.iq',
        415 => '.mil.iq',
        416 => '.org.iq',
        417 => '.net.iq',
        418 => '.ir',
        419 => '.ac.ir',
        420 => '.co.ir',
        421 => '.gov.ir',
        422 => '.id.ir',
        423 => '.net.ir',
        424 => '.org.ir',
        425 => '.sch.ir',
        426 => '.dnssec.ir',
        427 => '.gov.it',
        428 => '.edu.it',
        429 => '.co.je',
        430 => '.net.je',
        431 => '.org.je',
        432 => '.com.jo',
        433 => '.net.jo',
        434 => '.gov.jo',
        435 => '.edu.jo',
        436 => '.org.jo',
        437 => '.mil.jo',
        438 => '.name.jo',
        439 => '.sch.jo',
        440 => '.ac.jp',
        441 => '.ad.jp',
        442 => '.co.jp',
        443 => '.ed.jp',
        444 => '.go.jp',
        445 => '.gr.jp',
        446 => '.lg.jp',
        447 => '.ne.jp',
        448 => '.or.jp',
        449 => '.co.ke',
        450 => '.or.ke',
        451 => '.ne.ke',
        452 => '.go.ke',
        453 => '.ac.ke',
        454 => '.sc.ke',
        455 => '.me.ke',
        456 => '.mobi.ke',
        457 => '.info.ke',
        458 => '.per.kh',
        459 => '.com.kh',
        460 => '.edu.kh',
        461 => '.gov.kh',
        462 => '.mil.kh',
        463 => '.net.kh',
        464 => '.org.kh',
        465 => '.com.ki',
        466 => '.biz.ki',
        467 => '.de.ki',
        468 => '.net.ki',
        469 => '.info.ki',
        470 => '.org.ki',
        471 => '.gov.ki',
        472 => '.edu.ki',
        473 => '.mob.ki',
        474 => '.tel.ki',
        475 => '.km',
        476 => '.com.km',
        477 => '.coop.km',
        478 => '.asso.km',
        479 => '.nom.km',
        480 => '.presse.km',
        481 => '.tm.km',
        482 => '.medecin.km',
        483 => '.notaires.km',
        484 => '.pharmaciens.km',
        485 => '.veterinaire.km',
        486 => '.edu.km',
        487 => '.gouv.km',
        488 => '.mil.km',
        489 => '.net.kn',
        490 => '.org.kn',
        491 => '.edu.kn',
        492 => '.gov.kn',
        493 => '.kr',
        494 => '.co.kr',
        495 => '.ne.kr',
        496 => '.or.kr',
        497 => '.re.kr',
        498 => '.pe.kr',
        499 => '.go.kr',
        500 => '.mil.kr',
        501 => '.ac.kr',
        502 => '.hs.kr',
        503 => '.ms.kr',
        504 => '.es.kr',
        505 => '.sc.kr',
        506 => '.kg.kr',
        507 => '.seoul.kr',
        508 => '.busan.kr',
        509 => '.daegu.kr',
        510 => '.incheon.kr',
        511 => '.gwangju.kr',
        512 => '.daejeon.kr',
        513 => '.ulsan.kr',
        514 => '.gyeonggi.kr',
        515 => '.gangwon.kr',
        516 => '.chungbuk.kr',
        517 => '.chungnam.kr',
        518 => '.jeonbuk.kr',
        519 => '.jeonnam.kr',
        520 => '.gyeongbuk.kr',
        521 => '.gyeongnam.kr',
        522 => '.jeju.kr',
        523 => '.edu.kw',
        524 => '.com.kw',
        525 => '.net.kw',
        526 => '.org.kw',
        527 => '.gov.kw',
        528 => '.com.ky',
        529 => '.org.ky',
        530 => '.net.ky',
        531 => '.edu.ky',
        532 => '.gov.ky',
        533 => '.com.kz',
        534 => '.edu.kz',
        535 => '.gov.kz',
        536 => '.mil.kz',
        537 => '.net.kz',
        538 => '.org.kz',
        539 => '.com.lb',
        540 => '.edu.lb',
        541 => '.gov.lb',
        542 => '.net.lb',
        543 => '.org.lb',
        544 => '.gov.lk',
        545 => '.sch.lk',
        546 => '.net.lk',
        547 => '.int.lk',
        548 => '.com.lk',
        549 => '.org.lk',
        550 => '.edu.lk',
        551 => '.ngo.lk',
        552 => '.soc.lk',
        553 => '.web.lk',
        554 => '.ltd.lk',
        555 => '.assn.lk',
        556 => '.grp.lk',
        557 => '.hotel.lk',
        558 => '.com.lr',
        559 => '.edu.lr',
        560 => '.gov.lr',
        561 => '.org.lr',
        562 => '.net.lr',
        563 => '.com.lv',
        564 => '.edu.lv',
        565 => '.gov.lv',
        566 => '.org.lv',
        567 => '.mil.lv',
        568 => '.id.lv',
        569 => '.net.lv',
        570 => '.asn.lv',
        571 => '.conf.lv',
        572 => '.com.ly',
        573 => '.net.ly',
        574 => '.gov.ly',
        575 => '.plc.ly',
        576 => '.edu.ly',
        577 => '.sch.ly',
        578 => '.med.ly',
        579 => '.org.ly',
        580 => '.id.ly',
        581 => '.ma',
        582 => '.net.ma',
        583 => '.ac.ma',
        584 => '.org.ma',
        585 => '.gov.ma',
        586 => '.press.ma',
        587 => '.co.ma',
        588 => '.tm.mc',
        589 => '.asso.mc',
        590 => '.co.me',
        591 => '.net.me',
        592 => '.org.me',
        593 => '.edu.me',
        594 => '.ac.me',
        595 => '.gov.me',
        596 => '.its.me',
        597 => '.priv.me',
        598 => '.org.mg',
        599 => '.nom.mg',
        600 => '.gov.mg',
        601 => '.prd.mg',
        602 => '.tm.mg',
        603 => '.edu.mg',
        604 => '.mil.mg',
        605 => '.com.mg',
        606 => '.com.mk',
        607 => '.org.mk',
        608 => '.net.mk',
        609 => '.edu.mk',
        610 => '.gov.mk',
        611 => '.inf.mk',
        612 => '.name.mk',
        613 => '.pro.mk',
        614 => '.com.ml',
        615 => '.net.ml',
        616 => '.org.ml',
        617 => '.edu.ml',
        618 => '.gov.ml',
        619 => '.presse.ml',
        620 => '.gov.mn',
        621 => '.edu.mn',
        622 => '.org.mn',
        623 => '.com.mo',
        624 => '.edu.mo',
        625 => '.gov.mo',
        626 => '.net.mo',
        627 => '.org.mo',
        628 => '.com.mt',
        629 => '.org.mt',
        630 => '.net.mt',
        631 => '.edu.mt',
        632 => '.gov.mt',
        633 => '.aero.mv',
        634 => '.biz.mv',
        635 => '.com.mv',
        636 => '.coop.mv',
        637 => '.edu.mv',
        638 => '.gov.mv',
        639 => '.info.mv',
        640 => '.int.mv',
        641 => '.mil.mv',
        642 => '.museum.mv',
        643 => '.name.mv',
        644 => '.net.mv',
        645 => '.org.mv',
        646 => '.pro.mv',
        647 => '.ac.mw',
        648 => '.co.mw',
        649 => '.com.mw',
        650 => '.coop.mw',
        651 => '.edu.mw',
        652 => '.gov.mw',
        653 => '.int.mw',
        654 => '.museum.mw',
        655 => '.net.mw',
        656 => '.org.mw',
        657 => '.com.mx',
        658 => '.net.mx',
        659 => '.org.mx',
        660 => '.edu.mx',
        661 => '.gob.mx',
        662 => '.com.my',
        663 => '.net.my',
        664 => '.org.my',
        665 => '.gov.my',
        666 => '.edu.my',
        667 => '.sch.my',
        668 => '.mil.my',
        669 => '.name.my',
        670 => '.com.nf',
        671 => '.net.nf',
        672 => '.arts.nf',
        673 => '.store.nf',
        674 => '.web.nf',
        675 => '.firm.nf',
        676 => '.info.nf',
        677 => '.other.nf',
        678 => '.per.nf',
        679 => '.rec.nf',
        680 => '.com.ng',
        681 => '.org.ng',
        682 => '.gov.ng',
        683 => '.edu.ng',
        684 => '.net.ng',
        685 => '.sch.ng',
        686 => '.name.ng',
        687 => '.mobi.ng',
        688 => '.biz.ng',
        689 => '.mil.ng',
        690 => '.gob.ni',
        691 => '.co.ni',
        692 => '.com.ni',
        693 => '.ac.ni',
        694 => '.edu.ni',
        695 => '.org.ni',
        696 => '.nom.ni',
        697 => '.net.ni',
        698 => '.mil.ni',
        699 => '.com.np',
        700 => '.edu.np',
        701 => '.gov.np',
        702 => '.org.np',
        703 => '.mil.np',
        704 => '.net.np',
        705 => '.edu.nr',
        706 => '.gov.nr',
        707 => '.biz.nr',
        708 => '.info.nr',
        709 => '.net.nr',
        710 => '.org.nr',
        711 => '.com.nr',
        712 => '.com.om',
        713 => '.co.om',
        714 => '.edu.om',
        715 => '.ac.om',
        716 => '.sch.om',
        717 => '.gov.om',
        718 => '.net.om',
        719 => '.org.om',
        720 => '.mil.om',
        721 => '.museum.om',
        722 => '.biz.om',
        723 => '.pro.om',
        724 => '.med.om',
        725 => '.edu.pe',
        726 => '.gob.pe',
        727 => '.nom.pe',
        728 => '.mil.pe',
        729 => '.sld.pe',
        730 => '.org.pe',
        731 => '.com.pe',
        732 => '.net.pe',
        733 => '.com.ph',
        734 => '.net.ph',
        735 => '.org.ph',
        736 => '.mil.ph',
        737 => '.ngo.ph',
        738 => '.i.ph',
        739 => '.gov.ph',
        740 => '.edu.ph',
        741 => '.com.pk',
        742 => '.net.pk',
        743 => '.edu.pk',
        744 => '.org.pk',
        745 => '.fam.pk',
        746 => '.biz.pk',
        747 => '.web.pk',
        748 => '.gov.pk',
        749 => '.gob.pk',
        750 => '.gok.pk',
        751 => '.gon.pk',
        752 => '.gop.pk',
        753 => '.gos.pk',
        754 => '.pwr.pl',
        755 => '.com.pl',
        756 => '.biz.pl',
        757 => '.net.pl',
        758 => '.art.pl',
        759 => '.edu.pl',
        760 => '.org.pl',
        761 => '.ngo.pl',
        762 => '.gov.pl',
        763 => '.info.pl',
        764 => '.mil.pl',
        765 => '.waw.pl',
        766 => '.warszawa.pl',
        767 => '.wroc.pl',
        768 => '.wroclaw.pl',
        769 => '.krakow.pl',
        770 => '.katowice.pl',
        771 => '.poznan.pl',
        772 => '.lodz.pl',
        773 => '.gda.pl',
        774 => '.gdansk.pl',
        775 => '.slupsk.pl',
        776 => '.radom.pl',
        777 => '.szczecin.pl',
        778 => '.lublin.pl',
        779 => '.bialystok.pl',
        780 => '.olsztyn.pl',
        781 => '.torun.pl',
        782 => '.gorzow.pl',
        783 => '.zgora.pl',
        784 => '.biz.pr',
        785 => '.com.pr',
        786 => '.edu.pr',
        787 => '.gov.pr',
        788 => '.info.pr',
        789 => '.isla.pr',
        790 => '.name.pr',
        791 => '.net.pr',
        792 => '.org.pr',
        793 => '.pro.pr',
        794 => '.est.pr',
        795 => '.prof.pr',
        796 => '.ac.pr',
        797 => '.com.ps',
        798 => '.net.ps',
        799 => '.org.ps',
        800 => '.edu.ps',
        801 => '.gov.ps',
        802 => '.plo.ps',
        803 => '.sec.ps',
        804 => '.co.pw',
        805 => '.ne.pw',
        806 => '.or.pw',
        807 => '.ed.pw',
        808 => '.go.pw',
        809 => '.belau.pw',
        810 => '.arts.ro',
        811 => '.com.ro',
        812 => '.firm.ro',
        813 => '.info.ro',
        814 => '.nom.ro',
        815 => '.nt.ro',
        816 => '.org.ro',
        817 => '.rec.ro',
        818 => '.store.ro',
        819 => '.tm.ro',
        820 => '.www.ro',
        821 => '.co.rs',
        822 => '.org.rs',
        823 => '.edu.rs',
        824 => '.ac.rs',
        825 => '.gov.rs',
        826 => '.in.rs',
        827 => '.com.sb',
        828 => '.net.sb',
        829 => '.edu.sb',
        830 => '.org.sb',
        831 => '.gov.sb',
        832 => '.com.sc',
        833 => '.net.sc',
        834 => '.edu.sc',
        835 => '.gov.sc',
        836 => '.org.sc',
        837 => '.co.sh',
        838 => '.com.sh',
        839 => '.org.sh',
        840 => '.gov.sh',
        841 => '.edu.sh',
        842 => '.net.sh',
        843 => '.nom.sh',
        844 => '.com.sl',
        845 => '.net.sl',
        846 => '.org.sl',
        847 => '.edu.sl',
        848 => '.gov.sl',
        849 => '.gov.st',
        850 => '.saotome.st',
        851 => '.principe.st',
        852 => '.consulado.st',
        853 => '.embaixada.st',
        854 => '.org.st',
        855 => '.edu.st',
        856 => '.net.st',
        857 => '.com.st',
        858 => '.store.st',
        859 => '.mil.st',
        860 => '.co.st',
        861 => '.edu.sv',
        862 => '.gob.sv',
        863 => '.com.sv',
        864 => '.org.sv',
        865 => '.red.sv',
        866 => '.co.sz',
        867 => '.ac.sz',
        868 => '.org.sz',
        869 => '.com.tr',
        870 => '.gen.tr',
        871 => '.org.tr',
        872 => '.biz.tr',
        873 => '.info.tr',
        874 => '.av.tr',
        875 => '.dr.tr',
        876 => '.pol.tr',
        877 => '.bel.tr',
        878 => '.tsk.tr',
        879 => '.bbs.tr',
        880 => '.k12.tr',
        881 => '.edu.tr',
        882 => '.name.tr',
        883 => '.net.tr',
        884 => '.gov.tr',
        885 => '.web.tr',
        886 => '.tel.tr',
        887 => '.tv.tr',
        888 => '.co.tt',
        889 => '.com.tt',
        890 => '.org.tt',
        891 => '.net.tt',
        892 => '.biz.tt',
        893 => '.info.tt',
        894 => '.pro.tt',
        895 => '.int.tt',
        896 => '.coop.tt',
        897 => '.jobs.tt',
        898 => '.mobi.tt',
        899 => '.travel.tt',
        900 => '.museum.tt',
        901 => '.aero.tt',
        902 => '.cat.tt',
        903 => '.tel.tt',
        904 => '.name.tt',
        905 => '.mil.tt',
        906 => '.edu.tt',
        907 => '.gov.tt',
        908 => '.edu.tw',
        909 => '.gov.tw',
        910 => '.mil.tw',
        911 => '.com.tw',
        912 => '.net.tw',
        913 => '.org.tw',
        914 => '.idv.tw',
        915 => '.game.tw',
        916 => '.ebiz.tw',
        917 => '.club.tw',
        918 => '.com.mu',
        919 => '.gov.mu',
        920 => '.net.mu',
        921 => '.org.mu',
        922 => '.ac.mu',
        923 => '.co.mu',
        924 => '.or.mu',
        925 => '.ac.mz',
        926 => '.co.mz',
        927 => '.edu.mz',
        928 => '.org.mz',
        929 => '.gov.mz',
        930 => '.com.na',
        931 => '.co.na',
        932 => '.ac.nz',
        933 => '.co.nz',
        934 => '.cri.nz',
        935 => '.geek.nz',
        936 => '.gen.nz',
        937 => '.govt.nz',
        938 => '.health.nz',
        939 => '.iwi.nz',
        940 => '.maori.nz',
        941 => '.mil.nz',
        942 => '.net.nz',
        943 => '.org.nz',
        944 => '.parliament.nz',
        945 => '.school.nz',
        946 => '.abo.pa',
        947 => '.ac.pa',
        948 => '.com.pa',
        949 => '.edu.pa',
        950 => '.gob.pa',
        951 => '.ing.pa',
        952 => '.med.pa',
        953 => '.net.pa',
        954 => '.nom.pa',
        955 => '.org.pa',
        956 => '.sld.pa',
        957 => '.com.pt',
        958 => '.edu.pt',
        959 => '.gov.pt',
        960 => '.int.pt',
        961 => '.net.pt',
        962 => '.nome.pt',
        963 => '.org.pt',
        964 => '.publ.pt',
        965 => '.com.py',
        966 => '.edu.py',
        967 => '.gov.py',
        968 => '.mil.py',
        969 => '.net.py',
        970 => '.org.py',
        971 => '.com.qa',
        972 => '.edu.qa',
        973 => '.gov.qa',
        974 => '.mil.qa',
        975 => '.net.qa',
        976 => '.org.qa',
        977 => '.asso.re',
        978 => '.com.re',
        979 => '.nom.re',
        980 => '.ac.ru',
        981 => '.adygeya.ru',
        982 => '.altai.ru',
        983 => '.amur.ru',
        984 => '.arkhangelsk.ru',
        985 => '.astrakhan.ru',
        986 => '.bashkiria.ru',
        987 => '.belgorod.ru',
        988 => '.bir.ru',
        989 => '.bryansk.ru',
        990 => '.buryatia.ru',
        991 => '.cbg.ru',
        992 => '.chel.ru',
        993 => '.chelyabinsk.ru',
        994 => '.chita.ru',
        995 => '.chita.ru',
        996 => '.chukotka.ru',
        997 => '.chuvashia.ru',
        998 => '.com.ru',
        999 => '.dagestan.ru',
        1000 => '.e-burg.ru',
        1001 => '.edu.ru',
        1002 => '.gov.ru',
        1003 => '.grozny.ru',
        1004 => '.int.ru',
        1005 => '.irkutsk.ru',
        1006 => '.ivanovo.ru',
        1007 => '.izhevsk.ru',
        1008 => '.jar.ru',
        1009 => '.joshkar-ola.ru',
        1010 => '.kalmykia.ru',
        1011 => '.kaluga.ru',
        1012 => '.kamchatka.ru',
        1013 => '.karelia.ru',
        1014 => '.kazan.ru',
        1015 => '.kchr.ru',
        1016 => '.kemerovo.ru',
        1017 => '.khabarovsk.ru',
        1018 => '.khakassia.ru',
        1019 => '.khv.ru',
        1020 => '.kirov.ru',
        1021 => '.koenig.ru',
        1022 => '.komi.ru',
        1023 => '.kostroma.ru',
        1024 => '.kranoyarsk.ru',
        1025 => '.kuban.ru',
        1026 => '.kurgan.ru',
        1027 => '.kursk.ru',
        1028 => '.lipetsk.ru',
        1029 => '.magadan.ru',
        1030 => '.mari.ru',
        1031 => '.mari-el.ru',
        1032 => '.marine.ru',
        1033 => '.mil.ru',
        1034 => '.mordovia.ru',
        1035 => '.mosreg.ru',
        1036 => '.msk.ru',
        1037 => '.murmansk.ru',
        1038 => '.nalchik.ru',
        1039 => '.net.ru',
        1040 => '.nnov.ru',
        1041 => '.nov.ru',
        1042 => '.novosibirsk.ru',
        1043 => '.nsk.ru',
        1044 => '.omsk.ru',
        1045 => '.orenburg.ru',
        1046 => '.org.ru',
        1047 => '.oryol.ru',
        1048 => '.penza.ru',
        1049 => '.perm.ru',
        1050 => '.pp.ru',
        1051 => '.pskov.ru',
        1052 => '.ptz.ru',
        1053 => '.rnd.ru',
        1054 => '.ryazan.ru',
        1055 => '.sakhalin.ru',
        1056 => '.samara.ru',
        1057 => '.saratov.ru',
        1058 => '.simbirsk.ru',
        1059 => '.smolensk.ru',
        1060 => '.spb.ru',
        1061 => '.stavropol.ru',
        1062 => '.stv.ru',
        1063 => '.surgut.ru',
        1064 => '.tambov.ru',
        1065 => '.tatarstan.ru',
        1066 => '.tom.ru',
        1067 => '.tomsk.ru',
        1068 => '.tsaritsyn.ru',
        1069 => '.tsk.ru',
        1070 => '.tula.ru',
        1071 => '.tuva.ru',
        1072 => '.tver.ru',
        1073 => '.tyumen.ru',
        1074 => '.udm.ru',
        1075 => '.udmurtia.ru',
        1076 => '.ulan-ude.ru',
        1077 => '.vladikavkaz.ru',
        1078 => '.vladimir.ru',
        1079 => '.vladivostok.ru',
        1080 => '.volgograd.ru',
        1081 => '.vologda.ru',
        1082 => '.voronezh.ru',
        1083 => '.vrn.ru',
        1084 => '.vyatka.ru',
        1085 => '.yakutia.ru',
        1086 => '.yamal.ru',
        1087 => '.yekaterinburg.ru',
        1088 => '.yuzhno-sakhalinsk.ru',
        1089 => '.ac.rw',
        1090 => '.co.rw',
        1091 => '.com.rw',
        1092 => '.edu.rw',
        1093 => '.gouv.rw',
        1094 => '.gov.rw',
        1095 => '.int.rw',
        1096 => '.mil.rw',
        1097 => '.net.rw',
        1098 => '.com.sa',
        1099 => '.edu.sa',
        1100 => '.gov.sa',
        1101 => '.med.sa',
        1102 => '.net.sa',
        1103 => '.org.sa',
        1104 => '.pub.sa',
        1105 => '.sch.sa',
        1106 => '.com.sd',
        1107 => '.edu.sd',
        1108 => '.gov.sd',
        1109 => '.info.sd',
        1110 => '.med.sd',
        1111 => '.net.sd',
        1112 => '.org.sd',
        1113 => '.tv.sd',
        1114 => '.a.se',
        1115 => '.ac.se',
        1116 => '.b.se',
        1117 => '.bd.se',
        1118 => '.c.se',
        1119 => '.d.se',
        1120 => '.e.se',
        1121 => '.f.se',
        1122 => '.g.se',
        1123 => '.h.se',
        1124 => '.i.se',
        1125 => '.k.se',
        1126 => '.l.se',
        1127 => '.m.se',
        1128 => '.n.se',
        1129 => '.o.se',
        1130 => '.org.se',
        1131 => '.p.se',
        1132 => '.parti.se',
        1133 => '.pp.se',
        1134 => '.press.se',
        1135 => '.r.se',
        1136 => '.s.se',
        1137 => '.t.se',
        1138 => '.tm.se',
        1139 => '.u.se',
        1140 => '.w.se',
        1141 => '.x.se',
        1142 => '.y.se',
        1143 => '.z.se',
        1144 => '.com.sg',
        1145 => '.edu.sg',
        1146 => '.gov.sg',
        1147 => '.idn.sg',
        1148 => '.net.sg',
        1149 => '.org.sg',
        1150 => '.per.sg',
        1151 => '.art.sn',
        1152 => '.com.sn',
        1153 => '.edu.sn',
        1154 => '.gouv.sn',
        1155 => '.org.sn',
        1156 => '.perso.sn',
        1157 => '.univ.sn',
        1158 => '.com.sy',
        1159 => '.edu.sy',
        1160 => '.gov.sy',
        1161 => '.mil.sy',
        1162 => '.net.sy',
        1163 => '.news.sy',
        1164 => '.org.sy',
        1165 => '.ac.th',
        1166 => '.co.th',
        1167 => '.go.th',
        1168 => '.in.th',
        1169 => '.mi.th',
        1170 => '.net.th',
        1171 => '.or.th',
        1172 => '.ac.tj',
        1173 => '.biz.tj',
        1174 => '.co.tj',
        1175 => '.com.tj',
        1176 => '.edu.tj',
        1177 => '.go.tj',
        1178 => '.gov.tj',
        1179 => '.info.tj',
        1180 => '.int.tj',
        1181 => '.mil.tj',
        1182 => '.name.tj',
        1183 => '.net.tj',
        1184 => '.nic.tj',
        1185 => '.org.tj',
        1186 => '.test.tj',
        1187 => '.web.tj',
        1188 => '.agrinet.tn',
        1189 => '.com.tn',
        1190 => '.defense.tn',
        1191 => '.edunet.tn',
        1192 => '.ens.tn',
        1193 => '.fin.tn',
        1194 => '.gov.tn',
        1195 => '.ind.tn',
        1196 => '.info.tn',
        1197 => '.intl.tn',
        1198 => '.mincom.tn',
        1199 => '.nat.tn',
        1200 => '.net.tn',
        1201 => '.org.tn',
        1202 => '.perso.tn',
        1203 => '.rnrt.tn',
        1204 => '.rns.tn',
        1205 => '.rnu.tn',
        1206 => '.tourism.tn',
        1207 => '.ac.tz',
        1208 => '.co.tz',
        1209 => '.go.tz',
        1210 => '.ne.tz',
        1211 => '.or.tz',
        1212 => '.biz.ua',
        1213 => '.cherkassy.ua',
        1214 => '.chernigov.ua',
        1215 => '.chernovtsy.ua',
        1216 => '.ck.ua',
        1217 => '.cn.ua',
        1218 => '.co.ua',
        1219 => '.com.ua',
        1220 => '.crimea.ua',
        1221 => '.cv.ua',
        1222 => '.dn.ua',
        1223 => '.dnepropetrovsk.ua',
        1224 => '.donetsk.ua',
        1225 => '.dp.ua',
        1226 => '.edu.ua',
        1227 => '.gov.ua',
        1228 => '.if.ua',
        1229 => '.in.ua',
        1230 => '.ivano-frankivsk.ua',
        1231 => '.kh.ua',
        1232 => '.kharkov.ua',
        1233 => '.kherson.ua',
        1234 => '.khmelnitskiy.ua',
        1235 => '.kiev.ua',
        1236 => '.kirovograd.ua',
        1237 => '.km.ua',
        1238 => '.kr.ua',
        1239 => '.ks.ua',
        1240 => '.kv.ua',
        1241 => '.lg.ua',
        1242 => '.lugansk.ua',
        1243 => '.lutsk.ua',
        1244 => '.lviv.ua',
        1245 => '.me.ua',
        1246 => '.mk.ua',
        1247 => '.net.ua',
        1248 => '.nikolaev.ua',
        1249 => '.od.ua',
        1250 => '.odessa.ua',
        1251 => '.org.ua',
        1252 => '.pl.ua',
        1253 => '.poltava.ua',
        1254 => '.pp.ua',
        1255 => '.rovno.ua',
        1256 => '.rv.ua',
        1257 => '.sebastopol.ua',
        1258 => '.sumy.ua',
        1259 => '.te.ua',
        1260 => '.ternopil.ua',
        1261 => '.uzhgorod.ua',
        1262 => '.vinnica.ua',
        1263 => '.vn.ua',
        1264 => '.zaporizhzhe.ua',
        1265 => '.zhitomir.ua',
        1266 => '.zp.ua',
        1267 => '.zt.ua',
        1268 => '.ac.ug',
        1269 => '.co.ug',
        1270 => '.go.ug',
        1271 => '.ne.ug',
        1272 => '.or.ug',
        1273 => '.org.ug',
        1274 => '.sc.ug',
        1275 => '.ac.uk',
        1276 => '.bl.uk',
        1277 => '.british-library.uk',
        1278 => '.co.uk',
        1279 => '.cym.uk',
        1280 => '.gov.uk',
        1281 => '.govt.uk',
        1282 => '.icnet.uk',
        1283 => '.jet.uk',
        1284 => '.lea.uk',
        1285 => '.ltd.uk',
        1286 => '.me.uk',
        1287 => '.mil.uk',
        1288 => '.mod.uk',
        1289 => '.mod.uk',
        1290 => '.national-library-scotland.uk',
        1291 => '.nel.uk',
        1292 => '.net.uk',
        1293 => '.nhs.uk',
        1294 => '.nhs.uk',
        1295 => '.nic.uk',
        1296 => '.nls.uk',
        1297 => '.org.uk',
        1298 => '.orgn.uk',
        1299 => '.parliament.uk',
        1300 => '.parliament.uk',
        1301 => '.plc.uk',
        1302 => '.police.uk',
        1303 => '.sch.uk',
        1304 => '.scot.uk',
        1305 => '.soc.uk',
        1306 => '.dni.us',
        1307 => '.fed.us',
        1308 => '.isa.us',
        1309 => '.kids.us',
        1310 => '.nsn.us',
        1311 => '.com.uy',
        1312 => '.edu.uy',
        1313 => '.gub.uy',
        1314 => '.mil.uy',
        1315 => '.net.uy',
        1316 => '.org.uy',
        1317 => '.co.ve',
        1318 => '.com.ve',
        1319 => '.edu.ve',
        1320 => '.gob.ve',
        1321 => '.info.ve',
        1322 => '.mil.ve',
        1323 => '.net.ve',
        1324 => '.org.ve',
        1325 => '.web.ve',
        1326 => '.co.vi',
        1327 => '.com.vi',
        1328 => '.k12.vi',
        1329 => '.net.vi',
        1330 => '.org.vi',
        1331 => '.ac.vn',
        1332 => '.biz.vn',
        1333 => '.com.vn',
        1334 => '.edu.vn',
        1335 => '.gov.vn',
        1336 => '.health.vn',
        1337 => '.info.vn',
        1338 => '.int.vn',
        1339 => '.name.vn',
        1340 => '.net.vn',
        1341 => '.org.vn',
        1342 => '.pro.vn',
        1343 => '.co.ye',
        1344 => '.com.ye',
        1345 => '.gov.ye',
        1346 => '.ltd.ye',
        1347 => '.me.ye',
        1348 => '.net.ye',
        1349 => '.org.ye',
        1350 => '.plc.ye',
        1351 => '.ac.yu',
        1352 => '.co.yu',
        1353 => '.edu.yu',
        1354 => '.gov.yu',
        1355 => '.org.yu',
        1356 => '.ac.za',
        1357 => '.agric.za',
        1358 => '.alt.za',
        1359 => '.bourse.za',
        1360 => '.city.za',
        1361 => '.co.za',
        1362 => '.cybernet.za',
        1363 => '.db.za',
        1364 => '.ecape.school.za',
        1365 => '.edu.za',
        1366 => '.fs.school.za',
        1367 => '.gov.za',
        1368 => '.gp.school.za',
        1369 => '.grondar.za',
        1370 => '.iaccess.za',
        1371 => '.imt.za',
        1372 => '.inca.za',
        1373 => '.kzn.school.za',
        1374 => '.landesign.za',
        1375 => '.law.za',
        1376 => '.lp.school.za',
        1377 => '.mil.za',
        1378 => '.mpm.school.za',
        1379 => '.ncape.school.za',
        1380 => '.net.za',
        1381 => '.ngo.za',
        1382 => '.nis.za',
        1383 => '.nom.za',
        1384 => '.nw.school.za',
        1385 => '.olivetti.za',
        1386 => '.org.za',
        1387 => '.pix.za',
        1388 => '.school.za',
        1389 => '.tm.za',
        1390 => '.wcape.school.za',
        1391 => '.web.za',
        1392 => '.ac.zm',
        1393 => '.co.zm',
        1394 => '.com.zm',
        1395 => '.edu.zm',
        1396 => '.gov.zm',
        1397 => '.net.zm',
        1398 => '.org.zm',
        1399 => '.sch.zm',
    );

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function getSld()
    {
        if(!$this->sld) {
            $this->_parse();
        }
        return $this->sld;
    }

    public function getTld()
    {
        if(!$this->tld) {
            $this->_parse();
        }
        return $this->tld;
    }

    public function getSldTld()
    {
        return array($this->getSld(), $this->getTld());
    }

    private function _parse()
    {
        if(strpos($this->string, '.') === false) {
            throw new \Exception('Invalid domain name');
        }

        if(strpos($this->string, '://')) {
            $urlData = parse_url($this->string);
            $hostData = explode('.', $urlData['host']);
        } else {
            $hostData = explode('.', $this->string);
        }

        $hostData = array_reverse($hostData);

        if (in_array('.' . $hostData[1] . '.' . $hostData[0], $this->urlMap) !== FALSE) {
            $this->sld = $hostData[2];
            $this->tld = $hostData[1] . '.' . $hostData[0];
        } else {
            $this->sld = $hostData[1];
            $this->tld = $hostData[0];
        }
    }
}