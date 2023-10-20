package com.arc115_ues_2023.deteccionincendios

import android.graphics.Color
import android.os.Bundle
import android.os.Handler
import android.util.Log
import android.widget.ImageView
import androidx.appcompat.app.AppCompatActivity
import com.arc115_ues_2023.deteccionincendios.databinding.ActivityMainBinding
import com.bumptech.glide.Glide
import retrofit2.Call
import retrofit2.Response
import java.util.Timer
import java.util.TimerTask



class MainActivity : AppCompatActivity() {

    lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        val handler = Handler()
        val timer = Timer()
        showGIF(binding.imageView)
        val task: TimerTask = object : TimerTask() {
            override fun run() {
                handler.post(Runnable {
                    try {
                        //Ejecuta tu AsyncTask!
                        val retrofitTraer = RetrofitClient.TraerDatosDeteccionIncendios.getAlarma()

                        retrofitTraer.enqueue(object : retrofit2.Callback<Alarma> {
                            override fun onResponse(call: Call<Alarma>, response: Response<Alarma>) {
                                //binding.conectarServidorTexto.text = "Conectado exitosamente"
                                //binding.conectarServidorTexto.setTextColor(Color.parseColor("#00FF00"))
                                binding.imageView.setImageResource(R.drawable.internet_ok)

                                var alarmas = response.body()
                                if(alarmas.isNullOrEmpty()){
                                    binding.alarma.setTextColor(Color.parseColor("#00FF00"))
                                    binding.alarma.text = "No se han detectado alarmas"
                                    binding.viewAlarma.setBackgroundColor(Color.parseColor("#009688"))
                                    binding.alarmaFecha.setTextColor(Color.parseColor("#FFFFFF"))
                                    binding.alarmaFecha.text = "Todo en orden"
                                    binding.alarmaHora.setTextColor(Color.parseColor("#FFFFFF"))
                                    binding.alarmaHora.text = "Sin alarmas"

                                } else{
                                    var descripcion_alarma = ""
                                    var tipo_alarma = ""
                                    var fecha_alarma = ""
                                    var hora_alarma = ""

                                    for(alarma in alarmas){
                                        descripcion_alarma = alarma.descripcion_alarma.toString()
                                        tipo_alarma = alarma.tipo_alarma.toString()
                                        fecha_alarma = alarma.fecha_alarma.toString()
                                        hora_alarma = alarma.hora_alarma.toString()
                                    }
                                    if(tipo_alarma=="fuego") {
                                        binding.viewAlarma.setBackgroundColor(Color.parseColor("#FF0000"))
                                        binding.alarma.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarma.text = "Fuego detectado"
                                        binding.alarmaFecha.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarmaFecha.text = "Fecha:\n" + fecha_alarma
                                        binding.alarmaHora.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarmaHora.text = "Hora:\n" + hora_alarma

                                    }
                                    if(tipo_alarma=="gas") {
                                        binding.viewAlarma.setBackgroundColor(Color.parseColor("#FF6F00"))
                                        binding.alarma.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarma.text = "Fuga de gas detectada"
                                        binding.alarmaFecha.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarmaFecha.text = "Fecha:\n" + fecha_alarma
                                        binding.alarmaHora.setTextColor(Color.parseColor("#FFFFFF"))
                                        binding.alarmaHora.text = "Hora:\n" + hora_alarma
                                    }
                                }

                            }

                            override fun onFailure(call: Call<Alarma>, t: Throwable) {
                                //binding.conectarServidorTexto.text = "Error al conectar"
                                //binding.conectarServidorTexto.setTextColor(Color.parseColor("#FF0000"))
                                binding.imageView.setImageResource(R.drawable.no_internet_connection)
                                binding.viewAlarma.setBackgroundColor(Color.parseColor("#202124"))
                                binding.alarma.setTextColor(Color.parseColor("#FF6B6B"))
                                binding.alarma.text = "No hay conexión al servidor"
                                binding.alarmaFecha.text = ""
                                binding.alarmaHora.text = ""
                            }
                        })

                    } catch (e: Exception) {
                        Log.e("error", e.message!!)
                    }
                })
            }
        }

        timer.schedule(task, 0, 3000) //ejecutar en intervalo de 3 segundos.




    }// end oncreate

    // metodo para mostrar el gif
    private fun showGIF(v:ImageView) {
        Glide.with(this).load(R.drawable.searching_internet).into(v)
    }

}