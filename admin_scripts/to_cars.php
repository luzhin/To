<?php

class To_carsController  extends CmsGenerator {
	
	public function index() {
		$this->prepareIndexData();
		$this->render('to/cars');
	}
	
	public function delete(){
		$db = Register::get('db');
		$indexField = $this->dataModel->getIndexField();
		$id = $this->request($indexField,0);
		if (!empty($id)){
			$this->model->delete(array($indexField => $id));
			$this->deleteAllTypesAllCatalogs($id);
		}
		$this->redirect('index',$this->dataModel->getModelName());
	}
	
	public function delete_list(){
		$db = Register::get('db');
		$indexField = $this->dataModel->getIndexField();
		$ids = $this->request("delete_list",0);
		if (!empty($ids)) {
			foreach ($ids as $id) {
				if (!empty($id)) {
					$this->model->delete(array($indexField => $id));
					$this->deleteAllTypesAllCatalogs($id);
				}
			}	
		}
		$this->redirect('index',$this->dataModel->getModelName());
	}
	
	function deleteAllTypesAllCatalogs($id){
		$db = Register::get('db');
		
		$sql = "SELECT * FROM ".DB_PREFIX."to_models WHERE car_id='".(int)$id."';";
		$res = $db->query($sql);
		if (isset($res) && count($res)>0){
			foreach ($res as $dd){

				/* *************** */
				$sql2 = "SELECT * FROM ".DB_PREFIX."to_types WHERE model_id='".(int)$dd['id']."';";
				$res2 = $db->query($sql2);
				if (isset($res2) && count($res2)>0){
					foreach ($res2 as $dd2){
						$db->post("DELETE FROM ".DB_PREFIX."to WHERE type_id='".(int)$dd2['id']."';");
						$db->post("DELETE FROM ".DB_PREFIX."to_types WHERE id='".(int)$dd2['id']."';");
					}
				}
				/* *************** */
				
				$db->post("DELETE FROM ".DB_PREFIX."to_models WHERE id='".(int)$dd['id']."';");
			}
		}
	}
	/*~*/
}

?>