<?php
namespace Martin\Reports;

use Carbon\Carbon;

trait Reporter {


    protected $reporterRelations;


    /**
     * Issues the command to get each row
     * depending on the results returned from the query
     *
     * @param array $fields
     * @param $from
     * @param $to
     * @return array
     */
    public function generateReport(array $fields, $from, $to)
    {
        $this->reporterRelations = $this->getRelationsFromArray($fields);

        $results = $this->with($this->reporterRelations)
            ->where('created_at', '>', (new Carbon($from)))
            ->where('created_at', '<', (new Carbon($to)));

        $lists = array();
        $lists[] = $fields;

        foreach ($results->get() as $rowModel)
            $lists[] = $this->generateRow($fields, $rowModel);

        return $lists;
    }


    /**
     * gets a list of the root key for the multidimensional arrays
     * that signify relations on the class
     *
     * @param array $fields
     * @return array
     */
    protected function getRelationsFromArray(array $fields)
    {
        $reporterRelations = [];
        foreach ($fields as $field)
        {
            $fieldArray = explode('.', $field);
            if (count($fieldArray) > 1)
                $reporterRelations[] = $fieldArray[0];
        }

        return $reporterRelations;
    }

    /**
     * Takes one result set and issues a command to parse out each field on that row
     *
     * @param array $fields
     * @param $rowModel
     * @return array
     */
    public function generateRow(array $fields, $rowModel)
    {
        $row = [];

        foreach ($fields as $field)
            $row[] = $this->generateCellForField($field, $rowModel);

        return $row;
    }


    public function generateCellForField($field, $rowModel)
    {
        $acceptableObjects = [
            'Carbon\\Carbon'
        ];

        $fieldArray = explode('.', $field);

        if (in_array($fieldArray[0], $this->reporterRelations))
            return $this->getDataFromRelation($fieldArray, $rowModel);

        if (count($fieldArray) == 1)
        {
            $action = $fieldArray[0];

            if (is_int($rowModel->$action)
                || is_string($rowModel->$action)
                || is_bool($rowModel->$action)
                || is_double($rowModel->$action)
                || is_null($rowModel->$action)
            )
                return $rowModel->$action;


            if (get_class($rowModel->$action) == "Carbon\\Carbon")
                return $rowModel->$action;

            if (in_array(get_class($rowModel->$action), $acceptableObjects))
                return $rowModel->$action;

            if (is_callable([$rowModel, $action]))
                return $rowModel->$action();


            return $rowModel->$action;
        }


        return "N/A05";
    }

    public function getDataFromRelation($fieldArray, $rowModel)
    {
        $count = count($fieldArray);

        if ($count == 2)
        {
            $model = $fieldArray[0];
            $parameter = $fieldArray[1];
            if (is_a($rowModel->$model, "Illuminate\\Database\\Eloquent\\Collection"))
                if ($rowModel->$model->isEmpty())
                    return "N/A06";

            if ($parameter == "firstRecord")
                return $rowModel->$model->first()->generateString();

            if ($parameter == "lastRecord")
                return $rowModel->$model->last()->generateString();

            if (isset($rowModel->$model->$parameter))
                return $rowModel->$model->$parameter;
            return "N/A02";
        }

        if ($count == 3)
        {
            $model = $fieldArray[0];
            $parameter = $fieldArray[1];
            $variable = $fieldArray[2];

            if ($parameter == "firstRecord")
                return $rowModel->$model->first()->$variable;
            if ($parameter == "lastRecord")
                return $rowModel->$model->last()->$variable;


            if (isset($rowModel->$model->$parameter->$variable))
                return $rowModel->$model->$parameter->$variable;

            return "N/A08";
        }

        if ($count == 4)
        {
            $model = $fieldArray[0];
            $parameter = $fieldArray[1];
            $parameter2 = $fieldArray[2];
            $variable = $fieldArray[3];

            if ($parameter == "firstRecord")
            {
                $newModel = $rowModel->$model->first();
                return $newModel->$parameter2->$variable;
            }

            if ($parameter == "lastRecord")
            {
                return $rowModel->$model->last()->$parameter2->$variable;
            }

            if ($parameter2 == "firstRecord")
            {
                $newModel = $rowModel->$model->$parameter->first();
                if ($newModel)
                    return $newModel->$variable;
                return "N/A10";
            }
            if ($parameter2 == "lastRecord")
            {
                return $rowModel->$model->$parameter->last()->$variable;
            }


            if (isset($rowModel->$model->$parameter->$variable))
                return $rowModel->$model->$parameter->$variable;

            return "N/A03";
        }
        return "N/A04";
    }
}