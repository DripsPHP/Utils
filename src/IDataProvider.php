<?php

namespace Drips\Utils;

interface IDataProvider
{
    public function insert($target, $data);

    public function update($target, $data, $where = null);

    public function delete($target, $where);

    public function select($target, $infos, $where = null);
}
