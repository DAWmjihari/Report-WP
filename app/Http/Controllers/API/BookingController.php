<?php

namespace App\Http\Controllers\Api;

use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *
 * El controlador BookingController és un controlador de tipus API.
 * Aquest controlador controlador només es crida des de una petició AJAX des de el client,
 * aquesta petició es tractada i retornada al client. La finalitat d'aquest controlador és retornar els clients que hagin fet una
 * reserva dins del interval de temps (Aquest interval de temps ho escollir el usuari des de la on es crida la API).
 * Aquest interval de temps arriba amb aquella petició AJAX anteriorment esmentada.
 *
 * @category   Api
 * @package    BookingController
 * @author     Mourad Jihari Motahhir <w2.mjihari@infomila.info>
 * @copyright  2020 Mourad Jihari
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 * @see        BookingController
 * @since      Fitxer disponible des de la relese 1.0
 * @deprecated Fitxer deprecated en la release 2.0
 */

class BookingController extends Controller
{
    // }}}
    // {{{ __invoke()

    /**
     * Aquest mètode se invoca automàticament a la hora de invocar el controlador des de
     * la les rutes del arxiu api.php que es troba en el directori:
     *
     * <samp>
     *
     *  routes/api.php
     *
     * </samp>
     *
     *
     * El primer i únic paràmetre esperat a la funció és de tipus Request.
     *
     * Un exemple del request esperat dins del mètode:
     *
     * <code>
     * {
     *   initial_date: 2020-06-01,
     *   final_date: 2020-06-30
     * }
     * </code>
     *
     *
     * @param request  El primer i únic argument que tenim en aquesta funció es de tipus Request, arriba amb dades quan
     * des de el client escollim un interval de dates y li donem a enviar, aquest realitza una petició AJAX al servidor
     * amb les dates que utilitzarem dins de la funció i aquestes dates vindran emmagatzemades dins d'aquest paràmetre.
     *
     * @return string Retorna un JSON amb el clients que hagin realitzat una reserva dins del interval de temps que hi tenim agafat del paràmetre
     * request.
     *
     * @throws Exception En cas de que el servidor hi tingui problemes a l'hora de realitzar el JSON de clients,
     * saltara una excepció y aquesta excepció la tractem y retornem un JSON amb un HTTP 500 on aquest error serà
     * tractat en el client, per informar el usuari de que hi hi un error en el servidor.
     *
     * @access public
     * @see El mètode __invoke() és cridat quan un script intenta trucar a un objecte com si fos una funció.
     * @since Mètode disponible des de Release 1.0
     */
    public function __invoke(Request $request)
    {
        /*
        * Aquest bloc condicional mira si el paràmetre
        * request ve omplert a traves de una petició AJAX.
        */
        if ($request->ajax()) {
            try {
                $requessOK = false;
                if (count($request->all()) != 0 && $request->get('initial_date') != null && $request->get('final_date') != null) {
                    $requessOK = true;
                    $customers = collect();
                    foreach (Appointment::whereBetween('start_date', [$request->get('initial_date'),$request->get('final_date')])->pluck('id')->toArray() as $id) {
                        foreach (Appointment::find($id)->customers as $customer) {
                            $customers->push($customer);
                        }
                    }
                }

                return (!$requessOK || $customers->count() == 0) ? response()->json(['message' => "Not Found"], 404) : response()->json($customers, 200);
            } catch (Exception $e) {
                return response()->json(['message' => "Internal Server Error"], 500);
            }
        }
        return redirect()->back();
    }
}