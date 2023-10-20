package com.arc115_ues_2023.deteccionincendios

import retrofit2.Call
import retrofit2.http.GET

interface TraerDatosDeteccionIncendios {
    @GET("leer-datos-DB.php")
    fun getAlarma(): Call<Alarma>
}