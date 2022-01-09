package com.kelompok.emajer.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.API.ApiBarang;
import com.kelompok.emajer.Model.barang.barang;
import com.kelompok.emajer.R;
import com.squareup.picasso.Picasso;

import java.util.List;

public class barangAdapter extends RecyclerView.Adapter<barangAdapter.barangViewHolder> {
    Context context;
    List<barang> barang;
    ApiBarang apiBarang;
    ImageView gbr_barang;

    public barangAdapter(Context context, List<barang> barangAdapters){
        this.context = context;
        this.barang = barangAdapters;
    }

    @NonNull
    @Override
    public barangViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_list_databarang, parent, false);
        apiBarang = APIUtils.getReqBarang();
        return new barangViewHolder(view);
//        barangViewHolder holder = new barangViewHolder(view);
//        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull barangViewHolder holder, int position) {
        barang dm = barang.get(position);

        String gbrBarang = dm.getFoto();
        Picasso.get().load("https://ws-tif.com/e-majer/images/barang/"+gbrBarang).into(gbr_barang);
        holder.cttNamaBarang.setText(" "+dm.getNama_barang());
        holder.cttJumlahBarang.setText(dm.getJumlah_barang());

    }

    @Override
    public int getItemCount() {
        return barang.size();
    }

    public class barangViewHolder extends RecyclerView.ViewHolder {
        TextView cttNamaBarang, cttJumlahBarang;
        public barangViewHolder(@NonNull View itemView) {
            super(itemView);
            cttNamaBarang = itemView.findViewById(R.id.ctt_namaBarang);
            cttJumlahBarang = itemView.findViewById(R.id.ctt_jumlahBarang);
            gbr_barang = itemView.findViewById(R.id.imageView5);
        }
    }
}
