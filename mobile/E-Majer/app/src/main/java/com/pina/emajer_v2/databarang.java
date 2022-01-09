package com.pina.emajer_v2;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.pina.emajer_v2.API.APIRequestCatatanPengeluaran;
import com.pina.emajer_v2.API.APIUtils;
import com.pina.emajer_v2.API.ApiBarang;
import com.pina.emajer_v2.API.RetrofitClient;
import com.pina.emajer_v2.Activity.Transaksi.CatatanPengeluaran.catatanpengeluaran;
import com.pina.emajer_v2.Adapter.barangAdapter;
import com.pina.emajer_v2.Model.CatatanPengeluaran.DataPengeluaranResponse;
import com.pina.emajer_v2.Model.Mading.MadingData;
import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.Model.barang.DataBarangResponse;
import com.pina.emajer_v2.Model.barang.barang;
import com.pina.emajer_v2.Model.DataModel;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class databarang extends AppCompatActivity {
    SessionManager SessionManager;
    RecyclerView recyclerView;
    ApiBarang apiBarang;
    List<barang> Barang = new ArrayList<>();
    String id_kelas;
//    private RecyclerView.LayoutManager lmData;
//    List<barang> Barang = new ArrayList<>();
//    TextView jumlah_saldo;
//    String Saldo = "0";
//    private Context ctx;
//    private List<DataModel> barang2;
//    private String id_kelas;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_databarang);
        SessionManager = new SessionManager(this);
        id_kelas = SessionManager.getIdKelas();

        apiBarang = APIUtils.getReqBarang();
        getDataBarang();
    }


    private void initRecyclerView(){
        recyclerView = findViewById(R.id.datbar_recycler);
        recyclerView.setHasFixedSize(true);
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(databarang.this, LinearLayoutManager.VERTICAL, false);
        recyclerView.setLayoutManager(linearLayoutManager);
    }

    private void getDataBarang(){
//        ApiBarang ardData = RetrofitClient.getClient1().create(ApiBarang.class);
        Call<DataBarangResponse> ambilData = apiBarang.ardGetData(id_kelas);
        ambilData.enqueue(new Callback<DataBarangResponse>() {
            @Override
            public void onResponse(Call<DataBarangResponse> call, Response<DataBarangResponse> response) {
//                if (response.isSuccessful()){
                    int kode = response.body().getKode();
                    String pesan = response.body().getPesan();
                    Barang = response.body().getData();
                    initRecyclerView();

                    barangAdapter adapter = new barangAdapter(databarang.this, Barang);
                    recyclerView.setAdapter(adapter);
                    adapter.notifyDataSetChanged();

//                    Toast.makeText(getBaseContext(), "Pesan: "+ pesan+" | kode: "+kode, Toast.LENGTH_SHORT).show();


//                }else{
//                    Toast.makeText(getBaseContext(), "Gagal ambil Data Barang ", Toast.LENGTH_SHORT).show();
//                }
            }

            @Override
            public void onFailure(Call<DataBarangResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(), "Gagal konek server: "+ t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void back(View v){
        startActivity(new Intent(databarang.this, HomeActivity.class));
    }
}