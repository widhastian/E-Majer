package com.pina.emajer_v2.Adapter;

import android.content.Context;
import android.content.Intent;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.pina.emajer_v2.API.ApiLoginRegister;
import com.pina.emajer_v2.API.RetrofitClient;
import com.pina.emajer_v2.EditProfilActivity;
import com.pina.emajer_v2.Model.DataModel;
import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.SessionManager;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class AdapterData extends AppCompatActivity {
    private Context ctx;
    private List<DataModel> listData;
    private List<DataModel> listAkun;
    private String id_akun;
    SessionManager SessionManager;

    private void getData(){
            SessionManager = new SessionManager(this);
            id_akun = SessionManager.getKelas();
            ApiLoginRegister ardData = RetrofitClient.getClient1().create(ApiLoginRegister.class);
            Call<ResponseModel> ambilData = ardData.ardGetData(id_akun);

            ambilData.enqueue(new Callback<ResponseModel>() {
                @Override
                public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {
                    int kode = response.body().getKode();
                    String pesan = response.body().getPesan();
                    listAkun = response.body().getData();

                    String varIdAkun= listAkun.get(0).getId();
                    String varNamaAkun = listAkun.get(0).getNama();
                    String varEmailAkun = listAkun.get(0).getEmail();
                    String varUsernameAkun = listAkun.get(0).getUsername();
                    String varPasswordAkun = listAkun.get(0).getPassword();
                    String varKelasAkun = listAkun.get(0).getId_kelas();

                    //Toast.makeText(ctx, "Kode : "+kode+" | Pesan : "+pesan+ " | Data : "+varIdLaundry+" | "+varNamaLaundry + " | "+varAlamatLaundry+" | "+varTeleponLaundry, Toast.LENGTH_SHORT).show();

                    Intent kirim = new Intent(ctx, EditProfilActivity.class);
                    kirim.putExtra("xId", varIdAkun);
                    kirim.putExtra("xNama", varNamaAkun);
                    kirim.putExtra("xEmail", varEmailAkun);
                    kirim.putExtra("xUsername", varUsernameAkun);
                    kirim.putExtra("xPassword", varPasswordAkun);
                    kirim.putExtra("xKelas", varKelasAkun);
                    ctx.startActivity(kirim);
                }

                @Override
                public void onFailure(Call<ResponseModel> call, Throwable t) {
                    Toast.makeText(ctx, "Gagal Menghubungi Server : " + t.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
        }
    }

