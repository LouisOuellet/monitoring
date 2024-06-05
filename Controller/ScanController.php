<?php
// Import additionnal class into the global namespace
use LaswitchTech\phpRouter\BaseController;

class ScanController extends BaseController {

	private $Database;

	public function __construct($Auth){

        // Namespace: /scan

		// Set the controller Authentication Policy
		$this->Public = true; // Set to false to require authentication

		// Set the controller Authorization Policy
		$this->Permission = false; // Set to true to require a permission for the namespace used.
		$this->Level = 1; // Set the permission level required

		// Initialize the Database model
		$this->Database = new DatabaseModel();

		// Call the parent constructor
		parent::__construct($Auth);
	}

    // Retrieve the file content for router
    public function indexRouterAction() {

        // Namespace: /scan/index

        // Initialize variables
        $return = [];

        // Get the request parameters
        $id = $_GET['id'] ?? null;
        $from = $_GET['from'] ?? strtotime('-1 day');
        $to = $_GET['to'] ?? strtotime(date('Y-m-d H:i:s'));

        // Convert the dates
        $from = date('Y-m-d H:i:s', $from);
        $to = date('Y-m-d H:i:s', $to);

        // Retrieve Scan list
        $return['scans'] = $this->Database->select("SELECT * FROM `scans`");

        // Check if id is provided
        if($id){

            // Retrieve the scan
            $return['scan'] = $this->Database->select("SELECT * FROM `scans` WHERE `id` = '$id'")[0];

            // Return the scan results
            $return['results'] = $this->Database->select("SELECT * FROM `results` WHERE `target` = ? AND `type` = ? AND `port` = ? AND `timestamp` BETWEEN '".$from."' AND '".$to."' ORDER BY `id` DESC", [$return['scan']['target'], $return['scan']['type'], $return['scan']['port']]);

            // Build the chart data
            $return['chart'] = [
                'labels' => [],
                'datasets' => []
            ];

            // Loop through the results
            foreach($return['results'] as $result){

                // Check if the label exists
                if(!in_array($result['timestamp'], $return['chart']['labels'])){

                    // Add the label
                    $return['chart']['labels'][] = $result['timestamp'];
                }

                // Check if the dataset exists
                if(!isset($return['chart']['datasets'][$result['type']])){

                    // Add the dataset
                    $return['chart']['datasets'][$result['type']] = [
                        'label' => $result['type'],
                        'data' => [],
                        'backgroundColor' => 'rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)',
                        'borderColor' => 'rgba(255,255,255,1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                    ];
                }

                // Add the data
                $return['chart']['datasets'][$result['type']]['data'][] = floatval($result['state']);
            }
        }

        // Return
        return $return;
    }
}
