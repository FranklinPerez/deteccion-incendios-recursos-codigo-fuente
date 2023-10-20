package com.arc115_ues_2023.deteccionincendios

import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.create

object RetrofitClient {

    private val  retrofit = Retrofit.Builder()
        .baseUrl("http://192.168.0.17/deteccion-incendios/")
        .addConverterFactory(GsonConverterFactory.create())
        .build()
    val TraerDatosDeteccionIncendios = retrofit.create(TraerDatosDeteccionIncendios::class.java)
}