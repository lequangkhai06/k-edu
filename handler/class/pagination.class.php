<?php
class Pagination
{
    protected $_config = array(
        'current_page'  => 1,
        'total_record'  => 1,
        'total_page'    => 1,
        'limit'         => 9,
        'start'         => 9,
        'link_full'     => '',
        'link_first'    => '',
        'range'         => 5,
        'min'           => 0,
        'max'           => 0
    );
    function init($config = array())
    {
        foreach ($config as $key => $val) {
            if (isset($this->_config[$key])) {
                $this->_config[$key] = $val;
            }
        }
        if ($this->_config['limit'] < 0) {
            $this->_config['limit'] = 0;
        }
        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
        if (!$this->_config['total_page']) {
            $this->_config['total_page'] = 1;
        }
        if ($this->_config['current_page'] < 1) {
            $this->_config['current_page'] = 1;
        }

        if ($this->_config['current_page'] > $this->_config['total_page']) {
            $this->_config['current_page'] = $this->_config['total_page'];
        }
        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
        $middle = ceil($this->_config['range'] / 2);
        if ($this->_config['total_page'] < $this->_config['range']) {
            $this->_config['min'] = 1;
            $this->_config['max'] = $this->_config['total_page'];
        } else {
            $this->_config['min'] = $this->_config['current_page'] - $middle + 1;
            $this->_config['max'] = $this->_config['current_page'] + $middle - 1;
            if ($this->_config['min'] < 1) {
                $this->_config['min'] = 1;
                $this->_config['max'] = $this->_config['range'];
            } else if ($this->_config['max'] > $this->_config['total_page']) {
                $this->_config['max'] = $this->_config['total_page'];
                $this->_config['min'] = $this->_config['total_page'] - $this->_config['range'] + 1;
            }
        }
    }
    private function __link($page)
    {
        if ($page <= 1 && $this->_config['link_first']) {
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }

    function html_course()
    {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<div class="mt-50 pt-30"><nav class="d-flex justify-content-center">';
            if ($this->_config['current_page'] > 0) {
                $p .= '<ul class="custom-pagination d-flex align-items-center justify-content-center">';
                if ($this->_config['current_page'] == 1) {
                    $p .= '<li class="previous disabled"><i class="bx bxs-chevrons-left"></i></li>';
                } else {
                    $p .= '<li class="previous"><a onclick="page=1;load_course()"><i class="bx bxs-chevrons-left"></i></a></li>';
                }
            }
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= '<li><span class="active">' . $i . '</span></li>';
                } else {
                    $p  .= '<li><a onclick="page=' . $i . ';load_course()">' . $i . '</a></li>';
                }
            }
            if ($this->_config['current_page'] > 0) {
                if ($this->_config['current_page'] == $this->_config['total_page']) {
                    $p .= '<li class="next disabled"><i class="bx bxs-chevrons-right"></i></li>';
                } else {
                    $p .= '<li class="next"><a onclick="page=' . $this->_config['total_page'] . ';load_course()"><i class="bx bxs-chevrons-right"></i></a></li>';
                }
            }
            $p .= '</ul></nav></div>';
        }
        return $p;
    }

    // function html_pagtion()
    // {
    //     $p = '';
    //     if ($this->_config['total_record'] > $this->_config['limit']) {
    //         $p = '<center><div class="margin-bottom-10"><div class="btn-group btn-group-sm btn-group-solid">';
    //         if ($this->_config['current_page'] > 0) {
    //             $p .= '<button type="button" class="btn green" onclick="page = 1;load_source_list()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button>';
    //         }
    //         for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
    //             if ($this->_config['current_page'] == $i) {
    //                 $p .= '<button type="button" class="btn green active" onclick="page=' . $i . ';load_source_list()">' . $i . '</button>';
    //             } else {
    //                 $p .= '<button type="button" class="btn green" onclick="page=' . $i . ';load_source_list()">' . $i . '</button>';
    //             }
    //         }
    //         //$p .= '<button type="button" class="btn green disnable">...</button>';
    //         if ($this->_config['current_page'] > 0) {
    //             $p .= '<button type="button" class="btn green" onclick="page=' . $this->_config['total_page'] . ';load_source_list()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>';
    //         }
    //         $p .= '</div></div></center>';
    //     }
    //     return $p;
    // }

    // function html_category()
    // {
    //     $p = '';
    //     if ($this->_config['total_record'] > $this->_config['limit']) {
    //         $p = '<center><div class="margin-bottom-10"><div class="btn-group btn-group-sm btn-group-solid">';
    //         if ($this->_config['current_page'] > 0) {
    //             $p .= '<button type="button" class="btn green" onclick="page = 1;load_category_list()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button>';
    //         }
    //         for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
    //             if ($this->_config['current_page'] == $i) {
    //                 $p .= '<button type="button" class="btn green active" onclick="page=' . $i . ';load_category_list()">' . $i . '</button>';
    //             } else {
    //                 $p .= '<button type="button" class="btn green" onclick="page=' . $i . ';load_category_list()">' . $i . '</button>';
    //             }
    //         }
    //         if ($this->_config['current_page'] > 0) {
    //             $p .= '<button type="button" class="btn green" onclick="page=' . $this->_config['total_page'] . ';load_category_list()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>';
    //         }

    //         $p .= '</div></div></center>';
    //     }
    //     return $p;
    // }

    // function html_pages()
    // {
    //     $p = '';
    //     if ($this->_config['total_record'] > $this->_config['limit']) {
    //         $p = '<nav class="text-center"><ul class="pagination">';
    //         if ($this->_config['current_page'] > 1) {
    //             $p .= '<li class="prev"><a role="button" onclick="page = 1;load_history()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>';
    //         }
    //         for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) {
    //             if ($this->_config['current_page'] == $i) {
    //                 $p .= '<li class="active"><a role="button" onclick="page=' . $i . ';load_history()">' . $i . '</a></li>';
    //             } else {
    //                 $p .= '<li><a role="button" onclick="page=' . $i . ';load_history()">' . $i . '</a></li>';
    //             }
    //         }
    //         if ($this->_config['current_page'] < $this->_config['total_page']) {
    //             $p .= '<li><a role="button" onclick="page=' . $this->_config['total_page'] . ';load_history()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
    //         }
    //         $p .= '</ul></nav>';
    //     }
    //     return $p;
    // }


    function getConfig()
    {
        return $this->_config;
    }
}

/* CONTACT: // LEQUANGKHAI  - FB.COM/KHAIDEVELOPER - ZALO.ME/0387290231 */
