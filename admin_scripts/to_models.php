<?php

class To_modelsController  extends CmsGenerator {
	
	public function index() {
		$this->prepareIndexData();
		$this->render('to/models');
	}
	
	public function prepareIndexData(){
		
		$car_id = $this->request("car_id",0);
		if (!$car_id)
			$this->redirectUrl('/admintools/to_cars/');
			
		$this->view->title = $this->dataModel->getListTitle();
		$fields = $this->dataModel->getListFields();
		$fieldTitles = array();
		foreach ($fields as $fieldName=>$field) {
			$fieldTitles[$fieldName] = $this->dataModel->getFieldLabel($fieldName);
		}
		$this->view->fieldTitles = $fieldTitles;
		$this->view->addUrl = '/admintools/'.$this->modelName.'/add/?car_id='.(int)$car_id;
		$this->view->addTitle = $this->dataModel->getAddTitle();
		$listIds = $this->view->acl->getListIds($this->controller);
		
		$this->view->data = $this->model->select()->where("car_id=?",(int)$car_id)->fetchAll();

		$this->view->dataModel = $this->dataModel;
		$this->view->indexField = $this->dataModel->getIndexField();
		
		$car = $this->getCar($car_id);
		
		$this->addBreadCrumb($this->dataModel->getListTitle(),'/admintools/'.$this->dataModel->getModelName());
		$this->addBreadCrumb($car['name'],'/admintools/to_cars/');
	}
	
	private function getCar($id){
		$db = Register::get('db');
		$sql = "SELECT * FROM ".DB_PREFIX."to_cars WHERE id='".(int)$id."';";
		return $db->get($sql);
	}
	
	public function save() {
		$form = $this->request('form');
		$indexField = $this->dataModel->getIndexField();
		$id = 0;
		if (!empty($form[$indexField]))
			$id = $form[$indexField];
		$form = $this->trimA($form);
		if (empty($id)){
			$this->model->insert($form);
		} else {
			$this->model->update($form,array($indexField => $id));
		}
		$this->redirect('index',$this->dataModel->getModelName(),'car_id='.(isset($form['car_id'])?$form['car_id']:''));
	}
	
	public function delete(){
		$db = Register::get('db');
		$indexField = $this->dataModel->getIndexField();
		$id = $this->request($indexField,0);
		
		$getCatById = ToModel::getModelById($id);
		
		if (!empty($id)){
			$this->model->delete(array($indexField => $id));
			$this->deleteAllTypesAllCatalogs($id);
		}
		$this->redirect('index',$this->dataModel->getModelName(),'car_id='.$getCatById['car_id']);
	}
	
	public function delete_list(){
		$db = Register::get('db');
		$indexField = $this->dataModel->getIndexField();
		$ids = $this->request("delete_list",0);
		
		$getCatById = ToModel::getModelById($ids[0]);
		
		if (!empty($ids)) {
			foreach ($ids as $id) {
				if (!empty($id)) {
					$this->model->delete(array($indexField => $id));
					$this->deleteAllTypesAllCatalogs($id);
				}
			}	
		}
		$this->redirect('index',$this->dataModel->getModelName(),'car_id='.$getCatById['car_id']);
	}
	
	function deleteAllTypesAllCatalogs($id){
		$db = Register::get('db');
		$sql = "SELECT * FROM ".DB_PREFIX."to_types WHERE model_id='".(int)$id."';";
		$res = $db->query($sql);
		if (isset($res) && count($res)>0){
			foreach ($res as $dd){
				$db->post("DELETE FROM ".DB_PREFIX."to WHERE type_id='".(int)$dd['id']."';");
				$db->post("DELETE FROM ".DB_PREFIX."to_types WHERE id='".(int)$dd['id']."';");
			}
		}
	}
}

?>