<?php
namespace App;

class Debug
{
    static $echo_debug = false;

    static $debug_log = [];

    static $timers = [];

    static function setEchoMode($new_value = true)
    {
        self::$echo_debug = $new_value;
    }

    static function showErrors($include_notices = false)
    {
        if ($include_notices) {
            error_reporting(E_ALL & ~E_STRICT);
        } else {
            error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);
        }

        ini_set('display_errors', 1);
    }

    // Logging

    static function print_r($item)
    {
        $row = ['type' => 'array', 'message' => $item];

        if (self::$echo_debug) {
            self::display($row);
        }

        self::$debug_log[] = $row;
    }

    static function display($info)
    {
        switch ($info['type']) {
            case 'divider':
                if (APP_IS_COMMAND_LINE) {
                    echo '---------------------------------------------' . "\n";
                } else {
                    echo '<div style="
                        padding: 3px;
                        background: #DDD;
                        border-left: 4px solid #DDD;
                        border-bottom: 1px solid #DDD;
                        margin: 0;"></div>';
                }
                break;

            case 'array':
                if (APP_IS_COMMAND_LINE) {
                    echo print_r($info['message'], true);
                    echo "\n";
                } else {
                    echo '<pre style="
                        padding: 3px; 
                        font-family: Consolas, Courier New, Courier, monospace; 
                        font-size: 12px; 
                        background: #EEE;
                        color: #111;
                        border-left: 4px solid #FFD24D; 
                        border-bottom: 1px solid #DDD;
                        margin: 0;">';

                    $message = print_r($info['message'], true);
                    if ($message) {
                        echo $message;
                    } else {
                        echo '&nbsp;';
                    }

                    echo '</pre>';
                }
                break;

            case 'log':
            default:
                if (APP_IS_COMMAND_LINE) {
                    echo $info['message'] . "\n";
                } else {
                    echo '<div style="
                        padding: 3px; 
                        font-family: Consolas, Courier New, Courier, monospace; 
                        font-size: 12px; 
                        background: #EEE;
                        color: #111;
                        border-left: 4px solid #4DA6FF; 
                        border-bottom: 1px solid #DDD;
                        margin: 0;">';
                    echo $info['message'];
                    echo '</div>';
                }
                break;
        }
    }

    static function divider()
    {
        $row = ['type' => 'divider'];

        if (self::$echo_debug) {
            self::display($row);
        }

        self::$debug_log[] = $row;
    }

    static function getLog()
    {
        return self::$debug_log;
    }

    // Retrieval

    static function printLog()
    {
        foreach (self::$debug_log as $log_row) {
            self::display($log_row);
        }
    }

    /**
     * Surrounds the specified callable function with a timer for observation.
     *
     * @param $timer_name
     * @param callable $timed_function
     */
    static function runTimer($timer_name, callable $timed_function)
    {
        self::startTimer($timer_name);

        $timed_function();

        self::endTimer($timer_name);
    }

    /**
     * Start a timer with the specified name.
     *
     * @param $timer_name
     */
    static function startTimer($timer_name)
    {
        self::$timers[$timer_name] = microtime(true);
    }

    /**
     * End a timer with the specified name, logging total time consumed.
     *
     * @param $timer_name
     */
    static function endTimer($timer_name)
    {
        $start_time = (isset(self::$timers[$timer_name])) ? self::$timers[$timer_name] : microtime(true);
        $end_time = microtime(true);

        $time_diff = $end_time - $start_time;
        self::log('Timer "' . $timer_name . '" completed in ' . round($time_diff, 3) . ' second(s).');

        unset(self::$timers[$timer_name]);
    }

    static function log($entry)
    {
        $row = ['type' => 'log', 'message' => $entry];

        if (self::$echo_debug) {
            self::display($row);
        }

        self::$debug_log[] = $row;
    }
}