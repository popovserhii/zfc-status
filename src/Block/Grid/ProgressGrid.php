<?php
/**
 * Status Progress Grid Block
 *
 * @category Agere
 * @package Agere_Status
 * @author Popov Sergiy <popov@agere.com.ua>
 * @datetime: 25.12.2015 21:31
 */
namespace Agere\Status\Block\Grid;

use DoctrineModule\Persistence\ProvidesObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

use Zend\Stdlib\Exception\RuntimeException;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Column\Type;

use Agere\Barcode\Column\Formatter;
use Agere\Spare\Model\Repository\ProductRepository;
use Agere\ZfcDataGrid\Block\AbstractGrid;

class ProgressGrid extends AbstractGrid implements ObjectManagerAwareInterface {

	use ProvidesObjectManager;

	protected $createButtonTitle = '';
	protected $backButtonTitle = '';

	public function init() {

		$grid = $this->getDataGrid();
		$grid->setId('statusProgress_grid');
		$grid->setTitle('История статусов');
		$grid->setRendererName('jqGrid');

		$colId = $this->add([
			'name' => 'Select',
			'construct' => ['id', 'statusProgress'],
			'identity' => true,
		])->getDataGrid()->getColumnByUniqueId('statusProgress_id');

		/* $this->add([
             'name' => 'Select',
             'construct' => ['id', 'material'],
             'label' => 'Номер приема',
             'width' => 1,
             'formatters' => [
                 [
                     'name' => 'Link',
                     'link' => ['href' => '/material-category/edit', 'placeholder_column' => $colId] // special config
                 ],
             ],
             'identity' => false,
         ]);*/

		$this->add([
			'name' => 'Select',
			'construct' => ['name', 'status'],
			'label' => 'Статус',
			'translation_enabled' => true,
			'width' => 2,
		]);

		$this->add([
			'name' => 'Select',
			'construct' => ['email', 'user'],
			'label' => 'Пользователь',
			'translation_enabled' => true,
			'width' => 2,
		]);

		$this->add([
			'name' => 'Select',
			'construct' => ['mnemo', 'module'],
			'label' => 'Модуль',
			'translation_enabled' => true,
			'width' => 2,
		]);

		$this->add([
			'name' => 'Select',
			'construct' => ['modifiedAt', 'statusProgress'],
			'label' => 'Дата',
			'translation_enabled' => true,
			'width' => 2,
			'type' => ['name' => 'DateTime'],
		]);

		return $grid;
	}

	/*public function initToolbar() {
		$grid = $this->getDataGrid();
		$toolbar = $this->getToolbar();
		$route = $this->getRouteMatch();

		//$actionBlock = $toolbar->createActionPanel();
		//$actionBlock = $this->block('block/admin/actionPanel');

		#$toolbar->createActionPanel('Standard')
			#->addAction('Delete', [$route->getMatchedRouteName() => [
			#	'controller' => $route->getParam('controller'),
			#	'action'     => 'delete',
			#]])->addAction('Change status', [$route->getMatchedRouteName() => [
			#	'controller' => $route->getParam('controller'),
			#	'action'     => 'changeStatus',
			#]], ['group' => 'prop', 'position' => 50])
		#; // action: what to do with selected items

		return $toolbar;
	}*/

}