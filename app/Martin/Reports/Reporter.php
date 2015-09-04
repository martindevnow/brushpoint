<?php
namespace Martin\Reports;

use Carbon\Carbon;
use ReflectionClass;

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
            ->where('created_at', '>', (Carbon::create($from['year'], $from['month'], $from['day'], 0, 0, 0, 'America/Toronto')))
            ->where('created_at', '<', (Carbon::create($to['year'], $to['month'], $to['day'], 23, 59, 59, 'America/Toronto')));

        $lists = array();
        $lists[] = $fields;

        foreach ($results->get() as $rowModel)
            $lists[] = $this->generateRow($fields, $rowModel);

        return $lists;
    }


    public function generateFileName(array $from, array $to)
    {
        return strtolower($this->shortName()) . '_'
        . $from['year'] .'-'. $this->zerofill($from['month'], 2) .'-'. $from['day']
        .'-to-'
        . $to['year'] .'-'. $this->zerofill($to['month'], 2) .'-'. $to['day']  .'.csv';
    }

    public function zerofill ($num, $zerofill = 5)
    {
        return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
    }



    /**
     * Generate the values for the report
     *
     * @param $request
     * @throws \Exception
     * @return array
     */
    public function getDatesFromRequest($request)
    {
        $to['year'] = $request->to_year;
        $to['month'] = $request->to_month;
        $to['day'] = $request->to_day;

        $from['year'] = $request->from_year;
        $from['month'] = $request->from_month;
        $from['day'] = $request->from_day;

        if ($to['year'] < $from['year'])
            throw new \Exception;

        if ($to['year'] == $from['year'] && $to['month'] < $from['month'])
            throw new \Exception;

        if ($to['year'] == $from['year'] && $to['month'] == $from['month'] && $to['day'] < $from['day'])
            throw new \Exception;

        return compact('from', 'to');
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

    public function shortName()
    {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }

}