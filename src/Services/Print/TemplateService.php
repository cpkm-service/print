<?php

namespace Cpkm\Print\Services;

use Illuminate\Support\Arr;
use App\Exceptions\ErrorException;
use DataTables;

/**
 * Class TemplateService.
 */
class TemplateService
{
    /** 
     * @access protected
     * @var PrintTemplateRepository
     * @version 1.0
     * @author Henry
    **/
    protected $PrintTemplateRepository;
    
    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct(
        ) {
        $this->PrintTemplateRepository      =   app(config('print.template.model'));
    }

    /**
     * 報價單列表
     * @param array $data
     * @version 1.0
     * @author Henry
     * @return \DataTables
     */
    public function index($data) {
        $where = Arr::only($data,[]);
        return DataTables::of($this->PrintTemplateRepository->listQuery($where))->make();
    }

    public function getPrintTemplate($id) {
        return $this->PrintTemplateRepository->getDetail($id);
    }

    /**
     * 更新訂購參數資料
     * @param array $updateData
     * @param string $id
     * @return object $model
     * @throws \App\Exceptions\Universal\ErrorException
     * @version 1.0
     * @author Henry
     */
    public function update(array $data, string $id) {
        return \DB::transaction(function() use ($data, $id){
            $updateData = Arr::only($data, $this->PrintTemplateRepository->getDetailFields());
            $model =  $this->getPrintTemplate($id);
            $result = $model->update($updateData);
            if(!$result){
                throw new ErrorException(__('backend.errors.updateFail'), 500);
            }
            return $model;
        });
    }

}