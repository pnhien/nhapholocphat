<?php
App::uses('AppController', 'Controller');
/**
 * BdsKhachHang Controller
 *
 * @property BdsKhachHang $BdsKhachHang
 */
class BdsKhachHangController extends AppController {
	public $uses = array (
			'BdsKhachHang',
			'BdsYeuCau',
			'TinhTrangKh',
			'LoaiTin',
			'NhomBds',
			'Province',
			'Huong',
			'ViTri',
			'LoaiTien'
	);
	
	/**
	 * Displays a view Results
	 */
	public function index() {
		$paraKhachHang = $this->request->query;
		
		$this->setInit();
		
		if(isset($paraKhachHang['id'])){
			$bdsKhachHangId = $paraKhachHang['id'];
			$bdsKhachHang = $this->getBdsKhachHang($bdsKhachHangId);
			$this->set('bdsKhachHang', $bdsKhachHang);
			$bdsYeuCauList = $this->getBdsYeuCau($bdsKhachHangId);
			$this->set('bdsYeuCauList', $bdsYeuCauList);
			return $this->render ( '/bdsKhachHang' );
		} else {
			$bdsKhachHang = $this->BdsKhachHang->create();
			$bdsKhachHang['BdsKhachHang']['NAME'] = "Cuong";
			$this->set('bdsKhachHang', $bdsKhachHang);
			return $this->render ( '/createBdsKhachHang' );
		}
	}
	
	private function setInit(){
		$tinhTrangKhList = $this->TinhTrangKh->find('all', array(
				'conditions' => array(
						'TinhTrangKh.DELETE_YMD IS NULL'
				))
		);
		$this->set('tinhTrangKhList', $tinhTrangKhList);
		
		$loaiTin = $this->LoaiTin->find('all', array(
				'conditions' => array(
						'LoaiTin.DELETE_YMD IS NULL',
						'LoaiTin.LA_KHACH_HANG = 1'
				))
		);
		$this->set('loaiTinlist', $loaiTin);
		
		$nhomBdsList = $this->NhomBds->find('all', array(
				'conditions' => array(
						'NhomBds.DELETE_YMD IS NULL'
				))
		);
		$this->set('nhomBdsList', $nhomBdsList);
		
		$provinceList = $this->Province->find('all', array(
				'conditions' => array(
						'Province.PROVINCE_STATUS = 1'
				))
		);
		$this->set('provinceList', $provinceList);
		$this->set('districtList', null);
		$this->set('wardList', null);
		$this->set('streetList', null);
		
		$huongList = $this->Huong->find('all', array(
				'conditions' => array(
						'Huong.DELETE_YMD IS NULL'
				))
		);
		$this->set('huongList', $huongList);
		
		$viTriList = $this->ViTri->find('all', array(
				'conditions' => array(
						'ViTri.DELETE_YMD IS NULL'
				))
		);
		$this->set('viTriList', $viTriList);
		
		$loaiTienList = $this->LoaiTien->find('all', array(
				'conditions' => array(
						'LoaiTien.DELETE_YMD IS NULL'
				))
		);
		$this->set('loaiTienList', $loaiTienList);
	}
}