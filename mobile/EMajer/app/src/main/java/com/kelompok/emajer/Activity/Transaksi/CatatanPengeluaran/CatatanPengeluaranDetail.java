package com.kelompok.emajer.Activity.Transaksi.CatatanPengeluaran;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.emajer.API.APIRequestCatatanPengeluaran;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.Model.CatatanPengeluaran.DataPengeluaranDetail;
import com.kelompok.emajer.Model.CatatanPengeluaran.DataPengeluaranResponse;
import com.kelompok.emajer.R;
import com.squareup.picasso.Picasso;

import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CatatanPengeluaranDetail extends AppCompatActivity {
    APIRequestCatatanPengeluaran apiRequestCatatanPengeluaran;
    String id_pengeluaran, nama_akun, total, tanggal, fotoNota;
    TextView dcttTanggal, dcttNama,dcttTotal;
    ImageView dcttGambar, btnBack;
    LinearLayout dcttLlayout;
    CheckBox[] ch;
    List<DataPengeluaranDetail> pDetailList = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detailcttpengeluaran);
        apiRequestCatatanPengeluaran = APIUtils.getReqCatatanPengeluaran();

        id_pengeluaran = getIntent().getStringExtra("id_pengeluaran");
        nama_akun = getIntent().getStringExtra("nama_akun");
        total = getIntent().getStringExtra("totalPengeluaran");
        tanggal = getIntent().getStringExtra("tanggal");
        fotoNota = getIntent().getStringExtra("foto");
        btnBack = (ImageView) findViewById(R.id.btnBack_dcttn_pengeluaran);
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
        getFindId();
        buildDataDetail();

//        Toast.makeText(getBaseContext(),"ID: "+id_pengeluaran+" | Nama: "+nama_akun, Toast.LENGTH_SHORT).show();
    }

    private void getFindId(){
        dcttTanggal = findViewById(R.id.dctt_tanggal);
        dcttNama = findViewById(R.id.dctt_nama);
        dcttGambar = findViewById(R.id.dctt_gambar);
        dcttTotal = findViewById(R.id.dctt_total);
        dcttLlayout = findViewById(R.id.dctt_linearLayout);
    }

    private void setFindId(){
        dcttTanggal.setText(tanggal);
        dcttNama.setText(nama_akun);
        dcttTotal.setText(formatRupiah(Double.parseDouble(total)));
        Picasso.get().load("https://ws-tif.com/e-majer/images/nota/"+fotoNota).into(dcttGambar);
    }

    private void setDataBeli(){
        List<DataPengeluaranDetail> dList = pDetailList;

        ch = new CheckBox[dList.size()];
        for(int i=0; i<dList.size(); i++) {
            ch[i] = new CheckBox(this);
            String namaBarang = dList.get(i).getNamaBarang();
            Integer jumlahBeli = dList.get(i).getJumlahBeli();
            ch[i].setText(jumlahBeli.toString() +" "+namaBarang);
            ch[i].setTextColor(Color.parseColor("#000000"));
            ch[i].setEnabled(false);
            ch[i].setButtonDrawable(0);
            dcttLlayout.addView(ch[i]);
        }

    }

    private void buildDataDetail(){
        Call<DataPengeluaranResponse> call = apiRequestCatatanPengeluaran.ambilDetailPengeluaran(id_pengeluaran);
        call.enqueue(new Callback<DataPengeluaranResponse>() {
            @Override
            public void onResponse(Call<DataPengeluaranResponse> call, Response<DataPengeluaranResponse> response) {
                if (response.isSuccessful()){
                    String msg = response.body().getPesan();
                    pDetailList = response.body().getDataPengeluaranDetail();
                    setFindId();
                    if(pDetailList != null){
                        setDataBeli();
                    }
//                    Toast.makeText(getBaseContext(), "Pesan: "+ pDetailList, Toast.LENGTH_SHORT).show();
                }else {
                    Toast.makeText(getBaseContext(), "Gagal ambil Detail Pengeluaran", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<DataPengeluaranResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(), "Gagal konek server: "+ t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    public String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }

}