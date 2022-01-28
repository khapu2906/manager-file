<?php

namespace Khapu\Directory\Traits\Queries;
use Exception;
trait WhereQuery
{
    protected function _checkOperator($first, $operator, $second)
    {
        $status = false;
        switch ($operator) {
            case '>':
                $status = ($first > $second) ? true : false;
                break;
            case '<':
                $status = ($first < $second) ? true : false;
                break;
            case '<=':
                $status = ($first <= $second) ? true : false;
                break;
            case '>=':
                $status = ($first >= $second) ? true : false;
                break;
            case '=':
                $status = ($first == $second) ? true : false;
                break;
        }
        return $status;
    }

    protected function _checkLogic($wheres, $dir, $flag = 0)
    {   
        $status = false;
        if (!isset($wheres[$flag])) {
            return true;
        }
        switch ($wheres[$flag]['logic']) {
            case 'and':
                if ($this->_checkOperator($dir[$wheres[$flag]['field']], $wheres[$flag]['operator'], $wheres[$flag]['value'])) {
                    $sta = true;
                    $status = ($sta && $this->_checkLogic($wheres, $dir, $flag + 1)) ? true : false;
                } else {
                    $status = false;
                }
                break;
            case 'or':
                if ($this->_checkOperator($dir[$wheres[$flag]['field']], $wheres[$flag]['operator'], $wheres[$flag]['value']) ||
                    $this->_checkOperator($dir[$wheres[$flag + 1]['field']], $wheres[$flag + 1]['operator'], $wheres[$flag + 1]['value'])) {
                    
                    $sta = true;
                    $status = ($sta && $this->_checkLogic($wheres, $dir, $flag + 2)) ? true : false;
                } else {
                    $status = false;
                }
                break;
        }
        return $status;
    } 

    protected function _checkWhere($dir, $status = false)
    {
        // $status = false;
        if (empty($this->where)) {
            return true;
        }
        $wheres = $this->where;
        return $this->_checkLogic($wheres, $dir);
    }

    public function where(array $conditions)
    {
        foreach ($conditions as $logic => $condition) {
            $element  = [];
            if (gettype($condition) == 'array') {
                if (array_search($logic, self::LOGICS)) {
                    $element['logic'] = $logic;
                } else {
                    $element['logic'] = 'and';
                }
            }
            foreach ($condition as $field => $con) {
                $element['field'] = $field;
                switch (gettype($con)) {
                    case 'array':
                    case 'object':
                        foreach ($con as $operator => $values) {
                            $element['operator'] = (array_search($operator, self::OPERATORS) >= 0) ? $operator : '=';
                            switch (gettype($values)) {
                                case 'array':
                                case 'object':
                                    foreach ($values as $value) {
                                        $element['logic'] = 'or';
                                        $element['value'] = $value;
                                        $this->where = array_merge_recursive($this->where, [$element]);
                                    }
                                    break;
                                default:
                                    $element['value'] = $values;
                                    $this->where = array_merge_recursive($this->where, [$element]);
                                    break;
                            }
                        }    
                        break;
                    default:
                        $element['operator'] = '=';
                        $element['value'] = $con;
                        $this->where = array_merge_recursive($this->where, [$element]);
                        break;
                }
            }
        }
        return $this;
    }
}
