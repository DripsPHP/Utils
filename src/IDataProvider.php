<?php

namespace Drips\Utils;

interface IDataProvider
{
    public function insert($target, array $data);

    public function update($target, array $data, array $where = array());

    public function delete($target, array $where = array());

    public function select($target, array $where = array());
}
